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

		if(!is_string($this->name))
			throw new \LogicException('You must specify name for event before schedule.');

		return wp_schedule_single_event($this->getTimestamp(), $this->getName(), $this->getArgs());
	}

	/**
	 * @inheritdoc
	 */
	public function unSchedule() {
		if(!is_int($this->timestamp))
			throw new \LogicException('You must specify valid timestamp of event before un schedule.');

		if(!is_string($this->name))
			throw new \LogicException('You must specify name for event before un schedule.');

		return wp_unschedule_event($this->getTimestamp(), $this->getName(), $this->getArgs());
	}

	/**
	 * @inheritdoc
	 */
	public function unScheduleAll() {
		return wp_clear_scheduled_hook($this->getName(), $this->getArgs());
	}

	/**
	 * @inheritdoc
	 */
	public function immediately() {
		$this->setTimestamp(time());
		return $this;
	}
}
