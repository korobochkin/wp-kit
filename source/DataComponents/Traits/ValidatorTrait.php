<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits;

use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Trait ValidatorTrait
 */
trait ValidatorTrait
{
    /**
     * @var \Symfony\Component\Validator\Validator\ValidatorInterface
     */
    protected $validator;

    /**
     * @return ValidatorInterface Validator which can validate your values.
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * Sets the Validator for your instance.
     *
     * @param ValidatorInterface $validator Validator which can validate your values.
     *
     * @return $this For chain calls.
     */
    public function setValidator(ValidatorInterface $validator)
    {
        $this->validator = $validator;

        return $this;
    }
}
