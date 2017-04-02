<?php
namespace Korobochkin\WPKit\DataComponents\Traits;

trait ConstraintTrait {

	/**
	 * @var array|\Symfony\Component\Validator\Constraint;
	 */
	protected $constraint;

	public function getConstraint() {
		return $this->constraint;
	}

	public function setConstraint($constraint) {
		$this->constraint = $constraint;
	}
}
