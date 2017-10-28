<?php
namespace Korobochkin\WPKit\AJAX;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationList;

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
     * @var AJAXInterface
     */
    protected $api;

    /**
     * @var ConstraintViolationList
     */
    protected $violationList;

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
        $this->enabledForLoggedIn = (bool)$enabledForLoggedIn;

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
        $this->enabledForNotLoggedIn = (bool)$enabledForNotLoggedIn;

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
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @inheritdoc
     */
    public function setApi(AJAXInterface $api)
    {
        $this->api = $api;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getRequest()
    {
        return $this->api->getRequest();
    }

    /**
     * @inheritdoc
     */
    public function getResponse()
    {
        return $this->api->getResponse();
    }

    /**
     * @inheritdoc
     */
    public function getViolationList()
    {
        return $this->violationList;
    }

    /**
     * @inheritdoc
     */
    public function setViolationList($violationList)
    {
        $this->violationList = $violationList;
    }

    /**
     * @inheritdoc
     */
    public function addViolation(ConstraintViolationInterface $violation)
    {
        $this->violationList->add($violation);

        return $this;
    }

    /**
     * @inheritdoc
     */
    abstract public function handleRequest();
}
