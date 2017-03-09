<?php
namespace Korobochkin\WPKit\DataComponents\Traits;

trait NameTrait {

	/**
	 * @var string The node name which used to save value in DB or access it.
	 */
	protected $name;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}
}
