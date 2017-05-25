<?php
namespace Korobochkin\WPKit\Cron;

abstract class AbstractCronEvent extends AbstractCronSingleEvent {

	use Traits\RecurrenceTrait;

	/**
	 * @inheritdoc
	 */
	public function schedule() {
		// TODO: update this method
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
		// TODO: update this method
		if(!is_int($this->timestamp))
			throw new \LogicException('You must specify valid timestamp of event before un schedule.');

		if(!is_string($this->name))
			throw new \LogicException('You must specify name for event before un schedule.');

		return wp_unschedule_event($this->getTimestamp(), $this->getName(), $this->getArgs());
	}
}
