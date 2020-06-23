<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Cron\Traits;

/**
 * Trait NameTrait
 * @package Korobochkin\WPKit\Cron\Traits
 */
trait NameTrait
{
    /**
     * @var string Name of event
     */
    protected $name;

    /**
     * Returns name of event.
     *
     * @return string Name of event
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets name of event.
     *
     * @param $name string Name of event.
     *
     * @return $this For chain calls.
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
