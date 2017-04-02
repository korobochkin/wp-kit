<?php
namespace Korobochkin\WPKit\Transients\Special;

use Korobochkin\WPKit\DataTransformers\BooleanToStringTransformer;
use Korobochkin\WPKit\Transients\AbstractTransient;
use Symfony\Component\Validator\Constraints;

class BoolTransient extends AbstractTransient {

	/**
	 * BoolTransient constructor.
	 */
	public function __construct() {
		$this->setDataTransformer(new BooleanToStringTransformer('1', '0'));
		$this->setDefaultValue(false);
	}

	/**
	 * @inheritdoc
	 */
	public function buildConstraint() {
		return array(
			new Constraints\NotNull(),
			new Constraints\Type(array(
				'type' => 'bool',
			))
		);
	}
}
