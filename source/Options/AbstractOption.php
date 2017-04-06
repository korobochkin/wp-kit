<?php
namespace Korobochkin\WPKit\Options;

use Korobochkin\WPKit\DataComponents\AbstractNode;
use Korobochkin\WPKit\DataComponents\Traits\DeleteTrait;

abstract class AbstractOption extends AbstractNode implements OptionInterface {

	use DeleteTrait;

	/**
	 * @var $autoload bool Flag which define how option should be loaded by WordPress.
	 */
	protected $autoload = true;

	/**
	 * @inheritdoc
	 */
	public function getValueFromWordPress() {
		$name = $this->getName();

		if(!$name) {
			throw new \LogicException('You must specify the name of option before calling any methods using name of option.');
		}

		return get_option($name);
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
		$name = $this->getName();

		if(!$name) {
			throw new \LogicException('You must specify the name of option before calling any methods using name of option.');
		}

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

			$name = $this->getName();

			if(!$name) {
				throw new \LogicException('You must specify the name of option before calling any methods using name of option.');
			}

			$result = update_option($name, $raw, $this->isAutoload());

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
