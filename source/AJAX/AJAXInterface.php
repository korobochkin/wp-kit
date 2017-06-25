<?php
namespace Korobochkin\WPKit\AJAX;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface AJAXInterface {

	/**
	 * @return ActionInterface[]
	 */
	public function getActions();

	/**
	 * @param ActionInterface[] $actions
	 *
	 * @return $this For chain calls.
	 */
	public function setActions($actions);

	/**
	 * @param ActionInterface $action Action instance to add.
	 *
	 * @return $this For chain calls.
	 */
	public function addAction(ActionInterface $action);

	/**
	 * @return Request
	 */
	public function getRequest();

	/**
	 * @param Request $request
	 *
	 * @return $this For chain calls.
	 */
	public function setRequest($request);

	/**
	 * @return Response
	 */
	public function getResponse();

	/**
	 * @param Response $response
	 *
	 * @return $this For chain calls.
	 */
	public function setResponse($response);

	public function load();

	public function lateConstruct();

	public function handleRequest();

	/**
	 * @see wp_send_json()
	 */
	public function send();
}
