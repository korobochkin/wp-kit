<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\MetaBoxes;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class MetaBoxStack
 */
class MetaBoxStack implements MetaBoxStackInterface
{
    /**
     * @var MetaBoxInterface[]
     */
    protected $metaBoxes = array();

    /**
     * @var ContainerInterface DI Container.
     */
    protected $container;

    /**
     * @inheritdoc
     */
    public function getMetaBoxes()
    {
        return $this->metaBoxes;
    }

    /**
     * @inheritdoc
     */
    public function setMetaBoxes(array $metaBoxes)
    {
        $this->metaBoxes = $metaBoxes;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addMetaBox(MetaBoxInterface $metaBox)
    {
        $this->metaBoxes[] = $metaBox;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function initialize()
    {
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function register()
    {
        foreach ($this->metaBoxes as $metaBox) {
            $metaBox->register();
        }
        return $this;
    }

    /**
     * @inheritdoc
     *
     * @return $this For chain calls.
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function get($id)
    {
        return $this->container->get($id);
    }
}
