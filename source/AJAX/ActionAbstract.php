<?php
namespace Korobochkin\WPKit\AJAX;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationList;

abstract class ActionAbstract implements ActionInterface {

	protected $enabledForLoggedIn = true;

	protected $enabledForNotLoggedIn = false;

	protected $name;

	/**
	 * @var AJAXInterface
	 */
	protected $api;

	/**
	 * @var ConstraintViolationList
	 */
	protected $violationList;

	public function isEnabledForLoggedIn() {
		return $this->enabledForLoggedIn;
	}

	public function setEnabledForLoggedIn($enabledForLoggedIn) {
		$this->enabledForLoggedIn = (bool) $enabledForLoggedIn;
		return $this;
	}

	public function isEnabledForNotLoggedIn() {
		return $this->enabledForNotLoggedIn;
	}

	public function setEnabledForNotLoggedIn($enabledForNotLoggedIn) {
		$this->enabledForNotLoggedIn = (bool) $enabledForNotLoggedIn;
		return $this;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getApi() {
		return $this->api;
	}

	/**
	 * @inheritdoc
	 */
	public function setApi(AJAXInterface $api) {
		$this->api = $api;
		return $this;
	}

	public function getRequest() {
		return $this->api->getRequest();
	}

	public function getResponse() {
		return $this->api->getResponse();
	}

	/**
	 * @inheritdoc
	 */
	public function getViolationList() {
		return $this->violationList;
	}

	/**
	 * @inheritdoc
	 */
	public function setViolationList($violationList) {
		$this->violationList = $violationList;
	}

	public function addViolation(ConstraintViolationInterface $violation) {
		$this->violationList->add($violation);
		return $this;
	}

	abstract public function handleRequest();
}
