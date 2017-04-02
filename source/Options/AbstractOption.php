<?php
namespace Korobochkin\WPKit\Options;

use Korobochkin\WPKit\DataComponents\AbstractNode;

abstract class AbstractOption extends AbstractNode implements OptionInterface {

	/**
	 * @var $autoload bool Flag which define how option should be loaded by WordPress.
	 */
	protected $autoload = true;

	/**
	 * @inheritdoc
	 */
	public function getValueFromWordPress() {
		return get_option($this->getName());
	}

	/**
	 * @inheritdoc
	 */
	public function isAutoload() {
		return $this->autoload;
	}

	/**
	 * @inheritdoc
	 */
	public function setAutoload($autoload) {
		$this->autoload = (bool) $autoload;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function deleteFromWP() {
		return delete_option($this->getName());
	}

	/**
	 * @inheritdoc
	 */
	public function flush() {
		if(isset($this->localValue)) {
			if($this->getDataTransformer()) {
				$raw = $this->getDataTransformer()->transform($this->localValue);
			} else {
				$raw =& $this->localValue;
			}

			$result = update_option($this->getName(), $raw, $this->isAutoload());

			if($result)
				$this->setLocalValue(null);

			return $result;
		}
		return true;
	}

	/**
	 * @inheritdoc
	 */
	public function updateValue($value, $autoload = null) {
		$this->setLocalValue($value);

		if(!is_null($autoload))
			$this->setAutoload($autoload);

		return $this->flush();
	}
}
