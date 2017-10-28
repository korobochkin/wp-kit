<?php
namespace Korobochkin\WPKit\AlmostControllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface ActionInterface
 */
interface ActionInterface
{
    /**
     * Returns the flag which indicate availability of this action for user.
     *
     * @return bool True if enabled for logged in users.
     */
    public function isEnabledForLoggedIn();

    /**
     * Sets the flag which indicate availability of this action for user.
     *
     * @param $enabledForLoggedIn bool True if enabled.
     *
     * @return $this For chain calls.
     */
    public function setEnabledForLoggedIn($enabledForLoggedIn);

    /**
     * Returns the flag which indicate availability of this action for user.
     *
     * @return bool True if enabled for NOT logged in users.
     */
    public function isEnabledForNotLoggedIn();

    /**
     * Sets the flag which indicate availability of this action for user.
     *
     * @param $enabledForNotLoggedIn bool True if enabled.
     *
     * @return $this For chain calls.
     */
    public function setEnabledForNotLoggedIn($enabledForNotLoggedIn);

    /**
     * Returns the current action name.
     *
     * @return string Name of action.
     */
    public function getName();

    /**
     * Sets the current action name.
     *
     * @param $name string Action name.
     *
     * @return $this For chain calls.
     */
    public function setName($name);

    /**
     * Returns the parent stack service.
     *
     * @return StackInterface
     */
    public function getStack();

    /**
     * Sets the parent stack service.
     *
     * @param StackInterface $stack Parent stack.
     *
     * @return $this For chain calls.
     */
    public function setStack(StackInterface $stack);

    /**
     * Returns HTTP Request.
     *
     * @return Request HTTP request.
     */
    public function getRequest();

    /**
     * Sets HTTP Request.
     *
     * @param Request $request HTTP request.
     *
     * @return $this For chain calls.
     */
    public function setRequest(Request $request);

    /**
     * Returns HTTP Response.
     *
     * @return Response HTTP response.
     */
    public function getResponse();

    /**
     * Sets HTTP Response.
     *
     * @param Response $response HTTP response.
     *
     * @return $this For chain calls.
     */
    public function setResponse(Response $response);

    /**
     * Handling HTTP requests.
     *
     * @return $this For chain calls.
     */
    public function handleRequest();
}
