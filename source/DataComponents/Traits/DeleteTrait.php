<?php
namespace Korobochkin\WPKit\DataComponents\Traits;

use Korobochkin\WPKit\DataComponents\NodeInterface;

trait DeleteTrait {

	/**
	 * @inheritdoc
	 */
	public function delete() {
		/**
		 * @var $this NodeInterface
		 */
		$result = $this->deleteFromWP();

		if($result)
			$this->setLocalValue(null);

		return $result;
	}
}
