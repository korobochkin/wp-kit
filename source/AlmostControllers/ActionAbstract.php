<?php
namespace Korobochkin\WPKit\AlmostControllers;

use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Class ActionAbstract
 */
abstract class ActionAbstract implements ActionInterface
{
    /**
     * @var bool Should we use this action for logged in users or not?
     */
    protected $enabledForLoggedIn = true;

    /**
     * @var bool Should we use this action for NOT logged in users or not?
     */
    protected $enabledForNotLoggedIn = false;

    /**
     * @var string Name of this action. Used in WordPress add_action function. Must be unique. You can store here the name of class.
     */
    protected $name;

    /**
     * @var StackInterface
     */
    protected $stack;

    /**
     * @var ConstraintViolationList A list of errors during this action execute.
     */
    protected $violationsList;

    /**
     * @inheritdoc
     */
    public function isEnabledForLoggedIn()
    {
        return $this->enabledForLoggedIn;
    }

    /**
     * @inheritdoc
     */
    public function setEnabledForLoggedIn($enabledForLoggedIn)
    {
        $this->enabledForLoggedIn = (bool) $enabledForLoggedIn;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isEnabledForNotLoggedIn()
    {
        return $this->enabledForNotLoggedIn;
    }

    /**
     * @inheritdoc
     */
    public function setEnabledForNotLoggedIn($enabledForNotLoggedIn)
    {
        $this->enabledForNotLoggedIn = (bool) $enabledForNotLoggedIn;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getStack()
    {
        return $this->stack;
    }

    /**
     * @inheritdoc
     */
    public function setStack(StackInterface $stack)
    {
        $this->stack = $stack;

        return $this;
    }

    /**
     * Returns a list of errors.
     *
     * @return ConstraintViolationList
     */
    public function getViolationsList()
    {
        return $this->violationsList;
    }

    /**
     * Sets a list of errors.
     *
     * @param ConstraintViolationList $violationsList A list of errors during this action execute.
     *
     * @return $this For chain calls.
     */
    public function setViolationsList(ConstraintViolationList $violationsList)
    {
        $this->violationsList = $violationsList;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getRequest()
    {
        return $this->stack->getRequest();
    }

    /**
     * @inheritdoc
     */
    public function getResponse()
    {
        return $this->stack->getResponse();
    }
}
