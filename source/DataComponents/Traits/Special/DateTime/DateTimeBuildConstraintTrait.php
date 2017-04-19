<?php
namespace Korobochkin\WPKit\DataComponents\Traits\Special\DateTime;

use Symfony\Component\Validator\Constraints;

trait DateTimeBuildConstraintTrait {

	public function buildConstraint() {
		return array(
			new Constraints\NotBlank(),
			new Constraints\DateTime(),
		);
	}
}
