<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Cron;

/**
 * Interface CronEventInterface
 * @package Korobochkin\WPKit\Cron
 */
interface CronEventInterface extends CronSingleEventInterface
{

    /**
     * Returns recurrence value.
     *
     * How often the event should reoccur. Valid values: hourly, twicedaily, daily
     *
     * @return string The recurrence of event.
     */
    public function getRecurrence();

    /**
     * Sets the desired recurrence for event.
     *
     * @param $recurrence string one of allowed and registered in WP values.
     *
     * @return $this For chain calls.
     */
    public function setRecurrence($recurrence);
}
