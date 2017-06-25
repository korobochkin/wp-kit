<?php
namespace Korobochkin\WPKit\AJAX;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface AJAXInterface {

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
	public function setActions($actions);

	/**
	 * Adds single action instance to the list.
	 *
	 * @param ActionInterface $action Action instance to add.
	 *
	 * @return $this For chain calls.
	 */
	public function addAction(ActionInterface $action);

	/**
	 * Returns the Request instance.
	 *
	 * @return Request
	 */
	public function getRequest();

	/**
	 * Sets the Request instance.
	 *
	 * @param Request $request
	 *
	 * @return $this For chain calls.
	 */
	public function setRequest(Request $request);

	/**
	 * Returns Response instance.
	 *
	 * @return Response
	 */
	public function getResponse();

	/**
	 * Sets Response instance.
	 *
	 * @param Response $response
	 *
	 * @return $this For chain calls.
	 */
	public function setResponse(Response $response);

	/**
	 * Register current actions from $this->actions variable.
	 *
	 * @return $this For chain calls.
	 */
	public function load();

	/**
	 * Setup any other related stuff for handling requests.
	 *
	 * Need to be called from $this->handleRequest() and prepare Request and Response objects for Action.
	 *
	 * @return $this For chain calls.
	 */
	public function lateConstruct();

	/**
	 * Handling HTTP requests and send Response back
	 *
	 * @see $this->send()
	 */
	public function handleRequest();

	/**
	 * Actually sends the headers and response body to the client.
	 *
	 * @see wp_send_json()
	 */
	public function send();
}
