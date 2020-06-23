<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Cron\Traits;

/**
 * Trait RecurrenceTrait
 * @package Korobochkin\WPKit\Cron\Traits
 */
trait RecurrenceTrait
{
    /**
     * @var string
     */
    protected $recurrence = 'hourly';

    /**
     * Returns recurrence value.
     *
     * How often the event should reoccur. Valid values: hourly, twicedaily, daily
     *
     * @return string The recurrence of event.
     */
    public function getRecurrence()
    {
        return $this->recurrence;
    }

    /**
     * Sets the desired recurrence for event.
     *
     * @param $recurrence string one of allowed and registered in WP values.
     *
     * @return $this For chain calls.
     */
    public function setRecurrence($recurrence)
    {
        $this->recurrence = $recurrence;

        return $this;
    }
}
