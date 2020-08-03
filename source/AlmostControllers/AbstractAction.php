<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\AlmostControllers;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Class ActionAbstract
 */
abstract class AbstractAction implements ActionInterface
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
     * @var string Name of this action. Used in WordPress add_action function.
     * Must be unique. You can store here the name of class.
     */
    protected $name;

    /**
     * @var StackInterface
     */
    protected $stack;

    /**
     * @var Request HTTP Request.
     */
    protected $request;

    /**
     * @var Response HTTP Response.
     */
    protected $response;

    /**
     * @var ConstraintViolationList A list of errors during this action execute.
     */
    protected $violationsList;

    /**
     * @var ContainerInterface DI Container.
     */
    protected $container;

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
     * @inheritdoc
     */
    public function getViolationsList()
    {
        return $this->violationsList;
    }

    /**
     * @inheritdoc
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
        return $this->request;
    }

    /**
     * @inheritdoc
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @inheritdoc
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function get($id)
    {
        return $this->container->get($id);
    }
}
