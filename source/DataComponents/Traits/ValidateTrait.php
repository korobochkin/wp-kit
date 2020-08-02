<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits;

use Korobochkin\WPKit\DataComponents\NodeInterface;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Trait ValidateTrait
 */
trait ValidateTrait
{

    /**
     * Returns violations list.
     *
     * Call this method only in try-catch statements.
     *
     * @throws \Exception Different exceptions can be throw by Symfony Validator. Usually this happens if value
     * have a non expected variable type.
     *
     * @return ConstraintViolationList Violations list.
     */
    public function validate()
    {
        /**
         * @var $this NodeInterface
         */
        return $this->getValidator()->validate($this->get(), $this->getConstraint());
    }

    /**
     * Validates the value and returns boolean.
     *
     * @return bool True if value valid. False otherwise.
     */
    public function isValid()
    {
        try {
            $errors = $this->validate();
            if (count($errors) === 0) {
                return true;
            }
        } catch (\Exception $exception) {
            return false;
        }

        return false;
    }

    /**
     * Returns violations list.
     *
     * Call this method only in try-catch statements.
     *
     * @param $value mixed Value which you want to validate.
     *
     * @throws \Exception Different exceptions can be throw by Symfony Validator. Usually this happens if value
     * have a non expected variable type.
     *
     * @return ConstraintViolationList Violations list.
     */
    public function validateValue($value)
    {
        /**
         * @var $this NodeInterface
         */
        return $this->getValidator()->validate($value, $this->getConstraint());
    }
}
