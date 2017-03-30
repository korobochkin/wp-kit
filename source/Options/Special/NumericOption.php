<?php
namespace Korobochkin\WPKit\Options\Special;

use Korobochkin\WPKit\Options\AbstractOption;
use Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer;
use Symfony\Component\Validator\Constraints;

class NumericOption extends AbstractOption {

	/**
	 * FloatOption constructor.
	 */
	public function __construct() {
		$this->setDataTransformer(new NumberToLocalizedStringTransformer(10));
		$this->setDefaultValue(0.0);
	}

	public function buildConstraint() {
		return array(
			new Constraints\NotBlank(),
			new Constraints\Type(array(
				'type' => 'float',
			)),
		);
	}
}
