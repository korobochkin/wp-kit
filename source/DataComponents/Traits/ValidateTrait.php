<?php
namespace Setka\Editor\Admin\Prototypes\Options\Traits;

use Symfony\Component\Validator\ConstraintViolationList;

trait ValidateTrait {

	public function validate() {
		/**
		 * @var ConstraintViolationList
		 */
		return $this->getValidator()->validate($this->getValue(), $this->getConstraint());
	}

	public function isValid() {
		$errors = $this->validate();
		if(count($errors) === 0) {
			return true;
		}
		return false;
	}

	public function validateValue($value) {
		/**
		 * @var ConstraintViolationList
		 */
		return $this->getValidator()->validate($value, $this->getConstraint());
	}
}
