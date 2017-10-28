<?php
namespace Korobochkin\WPKit\AlmostControllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface StackInterface
{
    /**
     * Returns actions instances in array.
     *
     * @return ActionInterface[]
     */
    public function getActions();

    /**
     * Sets actions instances array.
     *
     * @param ActionInterface[] $actions
     *
     * @return $this For chain calls.
     */
    public function setActions(array $actions);

    /**
     * Adds single action instance to the list.
     *
     * @param ActionInterface $action Action instance to add.
     *
     * @return $this For chain calls.
     */
    public function addAction(ActionInterface $action);

    /**
     * Returns WordPress action name.
     *
     * @return string WordPress action name.
     */
    public function getActionName();

    /**
     * Sets WordPress action name.
     *
     * @param string $actionName
     *
     * @return $this For chain calls.
     */
    public function setActionName($actionName);

    /**
     * Returns the Request instance.
     *
     * @return Request HTTP request instance.
     */
    public function getRequest();

    /**
     * Sets the Request instance.
     *
     * @param Request $request HTTP request instance.
     *
     * @return $this For chain calls.
     */
    public function setRequest(Request $request);

    /**
     * Returns Response instance.
     *
     * @return Response HTTP response instance.
     */
    public function getResponse();

    /**
     * Sets Response instance.
     *
     * @param Response $response HTTP response instance.
     *
     * @return $this For chain calls.
     */
    public function setResponse(Response $response);

    /**
     * Returns Validator.
     *
     * @return ValidatorInterface Validator.
     */
    public function getValidator();

    /**
     * Sets Validator.
     *
     * @param ValidatorInterface $validator Validator.
     *
     * @return $this For chain calls.
     */
    public function setValidator(ValidatorInterface $validator);

    /**
     * Register current actions from $this->actions variable.
     *
     * @return $this For chain calls.
     */
    public function register();

    /**
     * Handling HTTP requests.
     *
     * @see $this->send()
     */
    public function handleRequest();

    /**
     * Actually sends the headers and response body to the client.
     */
    public function send();
}
