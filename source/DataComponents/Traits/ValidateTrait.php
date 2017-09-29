<?php
namespace Korobochkin\WPKit\DataComponents\Traits;

use Korobochkin\WPKit\DataComponents\NodeInterface;
use Symfony\Component\Validator\ConstraintViolationList;

trait ValidateTrait
{

    /**
     * Returns violations list.
     *
     * @return ConstraintViolationList
     */
    public function validate()
    {
        /**
         * @var $this NodeInterface
         */
        return $this->getValidator()->validate($this->get(), $this->getConstraint());
    }

    public function isValid()
    {
        $errors = $this->validate();
        if (count($errors) === 0) {
            return true;
        }

        return false;
    }

    /**
     * Returns violations list.
     *
     * @param $value mixed Value which you want to validate.
     *
     * @return ConstraintViolationList
     */
    public function validateValue($value)
    {
        /**
         * @var $this NodeInterface
         */
        return $this->getValidator()->validate($value, $this->getConstraint());
    }
}
