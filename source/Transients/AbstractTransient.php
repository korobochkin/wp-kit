<?php
namespace Korobochkin\WPKit\Transients;

use Korobochkin\WPKit\DataComponents\AbstractNode;
use Korobochkin\WPKit\DataComponents\Traits\DeleteTrait;

abstract class AbstractTransient extends AbstractNode implements TransientInterface {

	use DeleteTrait;

	/**
	 * @var $expiration int Expiration of transient.
	 */
	protected $expiration = 1;

	/**
	 * @inheritdoc
	 */
	public function getValueFromWordPress() {
		return get_transient($this->getName());
	}

	/**
	 * @inheritdoc
	 */
	public function getExpiration() {
		return $this->expiration;
	}

	/**
	 * @inheritdoc
	 */
	public function setExpiration($expiration) {
		$this->expiration = $expiration;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function deleteFromWP() {
		return delete_transient($this->getName());
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

			$result = set_transient($this->getName(), $raw, $this->getExpiration());

			if($result)
				$this->setLocalValue(null);

			return $result;
		}
		return true;
	}

	/**
	 * @inheritdoc
	 */
	public function updateValue($value, $expiration = null) {
		$this->setLocalValue($value);

		if(!is_null($expiration))
			$this->setExpiration($expiration);

		return $this->flush();
	}
}
