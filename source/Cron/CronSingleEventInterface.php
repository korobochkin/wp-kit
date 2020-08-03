<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Cron;

/**
 * Interface CronSingleEventInterface
 * @package Korobochkin\WPKit\Cron
 */
interface CronSingleEventInterface
{

    /**
     * Returns the event name which can be used as WordPress action name.
     *
     * @return string The event name.
     */
    public function getName();

    /**
     * Sets the event name which can be used as WordPress action name.
     *
     * @param $name string The name of event. Prefix it if possibly with your custom plugin or theme slug.
     *
     * @return $this For chain calls.
     */
    public function setName($name);

    /**
     * Returns the hook (function) which WordPress will call.
     *
     * @return callable The hook that WordPress will call.
     */
    public function getHook();

    /**
     * Sets the hook (function) which WordPress will call.
     *
     * @param $hook callable The hook that WordPress will call.
     *
     * @return $this For chain calls.
     */
    public function setHook($hook);

    /**
     * Register event in WordPress.
     *
     * @throws \RuntimeException
     *
     * @return $this
     */
    public function schedule();

    /**
     * Delete single event in WordPress based on args and timestamp.
     *
     * @throws \RuntimeException
     *
     * @return $this
     */
    public function unschedule();

    /**
     * Delete all events in WordPress with event name.
     *
     * @return $this For chain calls.
     */
    public function unscheduleAll();

    /**
     * Returns the timestamp.
     *
     * @return int The time you want the event to occur. This must be in a UNIX timestamp format.
     */
    public function getTimestamp();

    /**
     * Sets the timestamp.
     *
     * @param $timestamp int The time you want the event to occur. This must be in a UNIX timestamp format.
     *
     * @return $this For chain calls.
     */
    public function setTimestamp($timestamp);

    /**
     * Mark this even runned ASAP.
     *
     * In other words this method setup current timestamp for this event.
     *
     * @return $this For chain calls.
     */
    public function immediately();

    /**
     * Returns the args for this particular event.
     *
     * @return array Args which will be passed to event during execution.
     */
    public function getArgs();

    /**
     * Sets the args for particular event.
     *
     * @param $args array Args for event.
     *
     * @return $this For chain calls.
     */
    public function setArgs(array $args);

    /**
     * Returns flag which show existing event.
     *
     * @return boolean True if scheduled, false if not.
     */
    public function isScheduled();
}
