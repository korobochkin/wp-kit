<?php
namespace Korobochkin\WPKit\Transients\Special;

use Korobochkin\WPKit\Transients\AbstractTransient;
use Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer;
use Symfony\Component\Validator\Constraints;

class NumericTransient extends AbstractTransient {

	/**
	 * NumericTransient constructor.
	 */
	public function __construct() {
		$this->setDataTransformer(new NumberToLocalizedStringTransformer(10));
		$this->setDefaultValue(0.0);
	}

	/**
	 * @inheritdoc
	 */
	public function buildConstraint() {
		return array(
			new Constraints\NotBlank(),
			new Constraints\Type(array(
				'type' => 'float',
			)),
		);
	}
}
