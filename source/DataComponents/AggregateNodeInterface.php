<?php
namespace Korobochkin\WPKit\DataComponents;

interface AggregateNodeInterface {

	/**
	 * Returns list of all children nodes as array.
	 *
	 * @return array The nodes list.
	 */
	public function getNodes();

	/**
	 * Adds single node to this instance.
	 *
	 * @param NodeInterface $node Node for adding.
	 *
	 * @return $this For chain calls.
	 */
	public function addNode(NodeInterface $node);

	/**
	 * Removes single node by name.
	 *
	 * @param $name string The node name.
	 *
	 * @return mixed ???
	 */
	public function removeNode($name);

	/**
	 * Gets single node by name.
	 *
	 * @param $name string The node name.
	 *
	 * @return mixed ???
	 */
	public function getNode($name);
}
