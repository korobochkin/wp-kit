<?php
namespace Korobochkin\WPKit\DataComponents\Traits;

class DefaultValueTrait {

	protected $defaultValue;

	public function getDefaultValue() {
		return $this->defaultValue;
	}

	public function setDefaultValue($defaultValue) {
		$this->defaultValue = $defaultValue;
		return $this;
	}
}
