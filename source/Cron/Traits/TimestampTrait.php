<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Cron\Traits;

/**
 * Trait TimestampTrait
 * @package Korobochkin\WPKit\Cron\Traits
 */
trait TimestampTrait
{
    /**
     * @var int The time you want the event to occur. This must be in a UNIX timestamp format.
     */
    protected $timestamp = 1;

    /**
     * Returns the timestamp.
     *
     * @return int The time you want the event to occur. This must be in a UNIX timestamp format.
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Sets the timestamp.
     *
     * @param $timestamp int The time you want the event to occur. This must be in a UNIX timestamp format.
     *
     * @return $this For chain calls.
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }
}
