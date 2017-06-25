<?php
namespace Korobochkin\WPKit\Options;

use Korobochkin\WPKit\DataComponents\AggregateNodeInterface;
use Korobochkin\WPKit\DataComponents\Traits\AggregateNodeTrait;

class AbstractAggregateOption extends AbstractOption implements AggregateNodeInterface {

	use AggregateNodeTrait;

	public function get() {

		throw new \Exception('Do not use this method in Aggregate node.');


		/**
		 * @var $this \Korobochkin\WPKit\Options\OptionInterface|\Korobochkin\WPKit\Transients\TransientInterface
		 */
		if($this->hasLocalValue())
			return $this->getLocalValue();

		$raw = $this->getValueFromWordPress();

		if($raw !== false) {
			$transformer = $this->getDataTransformer();

			if($transformer) {
				$raw = $transformer->reverseTransform($raw);
			}

			$raw = wp_parse_args($raw, $this->getDefaultValue());

			return $raw;
		}

		return $this->getDefaultValue();
	}

	public function set($value) {
		throw new \Exception('Do not use this method in Aggregate node.');
	}

	public function getLocalValue() {
		throw new \Exception('Do not use this method in Aggregate node.');
	}

	public function setLocalValue($value) {
		throw new \Exception('Do not use this method in Aggregate node.');
	}

	public function hasLocalValue() {
		throw new \Exception('Do not use this method in Aggregate node.');
	}

	public function getDefaultValue() {
		throw new \Exception('Do not use this method in Aggregate node.');
	}

	public function setDefaultValue($defaultValue) {
		throw new \Exception('Do not use this method in Aggregate node.');
	}

	public function hasDefaultValue() {
		throw new \Exception('Do not use this method in Aggregate node.');
	}

	public function deleteLocal() {
		throw new \Exception('Do not use this method in Aggregate node.');
	}
}
