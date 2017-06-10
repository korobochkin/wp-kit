<?php
namespace Korobochkin\WPKit\Cron\Traits;

/**
 * Trait NameTrait
 * @package Korobochkin\WPKit\Cron\Traits
 */
trait NameTrait {

	protected $name;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
		return $this;
	}
}
