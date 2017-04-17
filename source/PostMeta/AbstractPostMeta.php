<?php
namespace Korobochkin\WPKit\PostMeta;

use Korobochkin\WPKit\DataComponents\AbstractNode;
use Korobochkin\WPKit\DataComponents\Traits\DeleteTrait;
use Korobochkin\WPKit\DataComponents\Traits\PostIdTrait;

abstract class AbstractPostMeta extends AbstractNode implements PostMetaInterface {

	use DeleteTrait;

	use PostIdTrait;

	/**
	 * @inheritdoc
	 */
	public function getValueFromWordPress() {
		$name = $this->getName();

		if(!$name) {
			throw new \LogicException('You must specify the name of post meta before calling any methods using name of post meta.');
		}

		$id = $this->getPostId();

		if(!$id) {
			throw new \LogicException('You must specify the ID of post meta before calling any methods using ID of post meta.');
		}

		return get_post_meta($id, $name, true);
	}

	/**
	 * @inheritdoc
	 */
	public function deleteFromWP() {
		$name = $this->getName();

		if(!$name) {
			throw new \LogicException('You must specify the name of post meta before calling any methods using name of post meta.');
		}

		$id = $this->getPostId();

		if(!$id) {
			throw new \LogicException('You must specify the ID of post meta before calling any methods using ID of post meta.');
		}

		return delete_post_meta($id, $name);
	}

	/**
	 * @inheritdoc
	 */
	public function flush() {
		if($this->getDataTransformer()) {
			$raw = $this->getDataTransformer()->transform($this->localValue);
		} else {
			$raw =& $this->localValue;
		}

		$name = $this->getName();

		if(!$name) {
			throw new \LogicException('You must specify the name of option before calling any methods using name of option.');
		}

		$id = $this->getPostId();

		if(!$id) {
			throw new \LogicException('You must specify the ID of post meta before calling any methods using ID of post meta.');
		}

		$result = update_post_meta($id, $name, $raw);

		if($result)
			$this->setLocalValue(null);

		return $result;
	}

	/**
	 * @inheritdoc
	 */
	public function updateValue($value) {
		$this->setLocalValue($value);
		return $this->flush();
	}
}
