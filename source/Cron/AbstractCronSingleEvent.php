<?php
namespace Korobochkin\WPKit\Cron;

abstract class AbstractCronSingleEvent implements CronSingleEventInterface {

	use Traits\NameTrait;

	use Traits\HookTrait;

	use Traits\ArgsTrait;

	use Traits\TimestampTrait;

	/**
	 * @inheritdoc
	 */
	public function schedule() {
		if(!is_int($this->timestamp))
			throw new \LogicException('You must specify valid timestamp of event before schedule.');

		if(!is_callable($this->hook))
			throw new \LogicException('You must specify callable hook for event before schedule.');

		return wp_schedule_single_event($this->getTimestamp(), $this->getHook(), $this->getArgs());
	}

	/**
	 * @inheritdoc
	 */
	public function unSchedule() {
		if(!is_int($this->timestamp))
			throw new \LogicException('You must specify valid timestamp of event before schedule.');

		if(!is_callable($this->hook))
			throw new \LogicException('You must specify callable hook for event before schedule.');

		return wp_unschedule_event($this->getTimestamp(), $this->getHook(), $this->getArgs());
	}

	/**
	 * @inheritdoc
	 */
	public function unScheduleAll() {
		return wp_clear_scheduled_hook($this->getHook(), $this->getArgs());
	}

	/**
	 * @inheritdoc
	 */
	public function immediately() {
		$this->setTimestamp(time());
		return $this;
	}
}
