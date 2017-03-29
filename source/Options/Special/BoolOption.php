<?php
namespace Korobochkin\WPKit\Options\Special;

use Korobochkin\WPKit\DataTransformers\BooleanToStringTransformer;
use Korobochkin\WPKit\Options\AbstractOption;
use Symfony\Component\Validator\Constraints;

class BoolOption extends AbstractOption {

	/**
	 * BoolOption constructor.
	 */
	public function __construct() {
		$this->setDataTransformer(new BooleanToStringTransformer('1', '0'));
	}

	public function buildConstraint() {
		return array(
			new Constraints\NotNull(),
			new Constraints\Type(array(
				'type' => 'bool',
			))
		);
	}
}
