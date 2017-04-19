<?php
namespace Korobochkin\WPKit\DataComponents\Traits\Special\Numeric;

use Symfony\Component\Validator\Constraints;

trait NumericBuildConstraintTrait {

	public function buildConstraint() {
		return array(
			new Constraints\NotBlank(),
			new Constraints\Type(array(
				'type' => 'float',
			)),
		);
	}
}
