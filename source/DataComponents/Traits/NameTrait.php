<?php
namespace Korobochkin\WPKit\DataComponents\Traits;

trait NameTrait {

	/**
	 * @var string The node name which is used to access the node must be unique.
	 */
	protected $name;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
		return $this;
	}
}
