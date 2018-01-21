<?php
namespace Korobochkin\WPKit\Cron;

/**
 * Class AbstractCronEvent
 * @package Korobochkin\WPKit\Cron
 */
abstract class AbstractCronEvent extends AbstractCronSingleEvent
{

    use Traits\RecurrenceTrait;

    /**
     * @inheritdoc
     */
    public function schedule()
    {
        if (!is_int($this->timestamp) || $this->timestamp <= 0) {
            throw new \LogicException('You must specify valid timestamp of event before schedule.');
        }

        if (!is_string($this->name)) {
            throw new \LogicException('You must specify name for event before schedule.');
        }

        $schedules = wp_get_schedules();
        if (!array_key_exists($this->recurrence, $schedules)) {
            throw new \LogicException('Invalid recurrence name. You should register before using.');
        }

        return wp_schedule_event(
            $this->getTimestamp(),
            $this->getRecurrence(),
            $this->getName(),
            $this->getArgs()
        );
    }
}
