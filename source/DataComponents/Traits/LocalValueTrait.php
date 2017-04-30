<?php
namespace Korobochkin\WPKit\DataComponents\Traits;

trait LocalValueTrait {

	protected $localValue;

	public function getLocalValue() {
		return $this->localValue;
	}

	public function setLocalValue($value) {
		$this->localValue = $value;
		return $this;
	}

	public function hasLocalValue() {
		return isset($this->localValue);
	}
}
