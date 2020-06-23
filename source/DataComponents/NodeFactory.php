<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents;

use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class NodeFactory
 */
class NodeFactory
{
    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * NodeFactory constructor.
     *
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Creates an instance of NodeInterface
     *
     * @param string $className Class implemented NodeInterface.
     *
     * @return NodeInterface Instance of passed class with validator and constraints.
     */
    public function create($className)
    {
        /**
         * @var $dataComponent NodeInterface
         */
        $dataComponent = new $className();

        $dataComponent
            ->setValidator($this->validator)
            ->setConstraint($dataComponent->buildConstraint());

        return $dataComponent;
    }

    /**
     * Returns validator.
     *
     * @return ValidatorInterface Validator instance.
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * Sets validator.
     *
     * @param ValidatorInterface $validator
     *
     * @return $this For chain calls.
     */
    public function setValidator(ValidatorInterface $validator)
    {
        $this->validator = $validator;
        return $this;
    }
}
