<?php
namespace Korobochkin\WPKit\Cron;

use Korobochkin\WPKit\Utils\CronUtils;

/**
 * Class AbstractCronSingleEvent
 * @package Korobochkin\WPKit\Cron
 */
abstract class AbstractCronSingleEvent implements CronSingleEventInterface
{
    use Traits\NameTrait;

    use Traits\HookTrait;

    use Traits\ArgsTrait;

    use Traits\TimestampTrait;

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

        return wp_schedule_single_event($this->getTimestamp(), $this->getName(), $this->getArgs());
    }

    /**
     * @inheritdoc
     */
    public function unschedule()
    {
        if (!is_int($this->timestamp) || $this->timestamp <= 0) {
            throw new \LogicException('You must specify valid timestamp of event before un schedule.');
        }

        if (!is_string($this->name)) {
            throw new \LogicException('You must specify name for event before un schedule.');
        }

        return wp_unschedule_event($this->getTimestamp(), $this->getName(), $this->getArgs());
    }

    /**
     * @inheritdoc
     */
    public function unscheduleAll()
    {
        CronUtils::unscheduleHook($this->getName());
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function immediately()
    {
        $this->setTimestamp(time());

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isScheduled()
    {
        $result = wp_next_scheduled($this->getName(), $this->getArgs());

        if (is_bool($result)) {
            return $result;
        }

        if (is_int($result) && $result > 0) {
            return true;
        }

        return false;
    }
}
