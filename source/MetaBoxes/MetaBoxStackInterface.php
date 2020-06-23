<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\MetaBoxes;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Interface MetaBoxStackInterface
 */
interface MetaBoxStackInterface extends ContainerAwareInterface
{
    /**
     * Returns meta boxes instances in array.
     *
     * @return MetaBoxInterface[]
     */
    public function getMetaBoxes();

    /**
     * Sets meta boxes instances array.
     *
     * @param MetaBoxInterface[] $metaBoxes
     *
     * @return $this For chain calls.
     */
    public function setMetaBoxes(array $metaBoxes);

    /**
     * Adds single meta box instance to the list.
     *
     * @param MetaBoxInterface $metaBox Meta box instance to add.
     *
     * @return $this For chain calls.
     */
    public function addMetaBox(MetaBoxInterface $metaBox);

    /**
     * Initialize required meta boxes and set in into local variable.
     *
     * @return $this For chain calls.
     */
    public function initialize();

    /**
     * Call register method on each meta box instance.
     *
     * @return $this For chain calls.
     */
    public function register();

    /**
     * Returns a container service by its id.
     *
     * @param string $id The service id.
     *
     * @return object The service.
     */
    public function get($id);
}
