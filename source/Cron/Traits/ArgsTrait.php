<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Cron\Traits;

/**
 * Trait ArgsTrait
 * @package Korobochkin\WPKit\Cron\Traits
 */
trait ArgsTrait
{

    /**
     * @var array Args for event.
     */
    protected $args = array();

    /**
     * Returns the args for this particular event.
     *
     * @return array Args which will be passed to event during execution.
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * Sets the args for particular event.
     *
     * @param $args array Args for event.
     *
     * @return $this For chain calls.
     */
    public function setArgs(array $args)
    {
        $this->args = $args;

        return $this;
    }
}
