<?php
declare(strict_types=1);

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

        $result = wp_schedule_single_event($this->getTimestamp(), $this->getName(), $this->getArgs());

        if (true === $result || null === $result) {
            return $this;
        } elseif (false === $result) {
            throw new \RuntimeException('Cannot schedule or event already scheduled.');
        } else {
            throw new \RuntimeException('Unknown result from WordPress function wp_schedule_single_event() returned.');
        }
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

        $result = wp_unschedule_event($this->getTimestamp(), $this->getName(), $this->getArgs());

        if (true === $result || null === $result) {
            return $this;
        } elseif (false === $result) {
            throw new \RuntimeException('Cannot delete event or event not exists.');
        } else {
            throw new \RuntimeException('Unknown result from WordPress function wp_unschedule_event() returned.');
        }
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

        if (is_int($result) && $result > 0) {
            return true;
        }

        return $result;
    }
}
