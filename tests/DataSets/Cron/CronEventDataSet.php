<?php
namespace Korobochkin\WPKit\Tests\DataSets\Cron;

use Korobochkin\WPKit\Tests\DataSets\AbstractDataSet;

class CronEventDataSet extends AbstractDataSet {

	/**
	 * CronEventDataSet constructor.
	 */
	public function __construct() {
		$time = time();

		$variants = array(
			array(0),
			array($time + MINUTE_IN_SECONDS),
			array($time + HOUR_IN_SECONDS),
			array($time + DAY_IN_SECONDS),
			array($time + WEEK_IN_SECONDS),
			array($time + YEAR_IN_SECONDS),
		);

		$this->variants = $variants;
		$this->position = 0;
	}
}
