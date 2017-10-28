<?php
namespace Korobochkin\WPKit\DataComponents;

interface AggregateNodeInterface
{

    /**
     * Returns all children nodes list in array.
     *
     * @return array The nodes list.
     */
    public function getNodes();

    /**
     * Add single node to this instance.
     *
     * @param NodeInterface $node Node to add
     *
     * @return $this For chain calls.
     */
    public function addNode(NodeInterface $node);

    /**
     * Remove single node by name.
     *
     * @param $name string The node name.
     *
     * @return mixed ???
     */
    public function removeNode($name);

    /**
     * Get single node by name.
     *
     * @param $name string The node name.
     *
     * @return mixed ???
     */
    public function getNode($name);
}
