<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits;

trait NameTrait
{
    /**
     * @var string The node name which used for access the node. Must be unique.
     */
    protected $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
