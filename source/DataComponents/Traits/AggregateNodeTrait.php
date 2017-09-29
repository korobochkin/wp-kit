<?php
namespace Korobochkin\WPKit\DataComponents\Traits;

use Korobochkin\WPKit\DataComponents\AggregateNodeInterface;
use Korobochkin\WPKit\DataComponents\NodeInterface;

trait AggregateNodeTrait {

	/**
	 * @var NodeInterface[]|AggregateNodeInterface[]
	 */
	protected $nodes;

	public function getNodes() {
		return $this->nodes;
	}

	public function addNode(NodeInterface $node) {
		$this->nodes[$node->getName()] = $node;
		return $this;
	}

	public function removeNode($name) {
		if(isset($this->nodes[$name])) {
			unset($this->nodes[$name]);
			return $this;
		}
		throw new \LogicException('The node with this name not exists.');
	}

	public function getNode($name) {
		if(isset($this->nodes[$name])) {
			$this->nodes[$name];
		}
		throw new \LogicException('The node with this name not exists.');
	}
}
