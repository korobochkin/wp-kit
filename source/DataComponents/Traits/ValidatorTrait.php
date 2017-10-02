<?php
namespace Korobochkin\WPKit\DataComponents\Traits;

use Symfony\Component\Validator\Validator\ValidatorInterface;

trait ValidatorTrait
{

    /**
     * @var \Symfony\Component\Validator\Validator\ValidatorInterface
     */
    protected $validator;

    public function getValidator()
    {
        return $this->validator;
    }

    public function setValidator(ValidatorInterface $validator)
    {
        $this->validator = $validator;

        return $this;
    }
}
