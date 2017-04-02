<?php
namespace Korobochkin\WPKit\DataComponents\Traits;

trait GetTrait {

	/**
	 * @inheritdoc
	 */
	public function get() {
		/**
		 * @var $this \Korobochkin\WPKit\DataComponents\NodeInterface
		 */
		if(isset($this->localValue))
			return $this->getLocalValue();

		$raw = $this->getValueFromWordPress();

		if($raw !== false) {
			$transformer = $this->getDataTransformer();
			if($transformer) {
				return $transformer->reverseTransform($raw);
			}
			return $raw;
		}

		return $this->getDefaultValue();
	}
}
