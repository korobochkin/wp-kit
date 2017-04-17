<?php
namespace Korobochkin\WPKit\DataComponents\Traits\Special\Bool;

use Symfony\Component\Validator\Constraints;

trait BoolBuildConstraintTrait {

	public function buildConstraint() {
		return array(
			new Constraints\NotNull(),
			new Constraints\Type(array(
				'type' => 'bool',
			))
		);
	}
}
