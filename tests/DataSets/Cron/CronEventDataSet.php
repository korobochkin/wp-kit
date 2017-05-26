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
			//    timestamp                  result      result
			//                               of          of
			//                               scheduling  un-scheduling
			array(0,                         false,      false),
			array($time,                     null,       null),
			array($time + MINUTE_IN_SECONDS, null,       null),
			array($time + HOUR_IN_SECONDS,   null,       null),
			array($time + DAY_IN_SECONDS,    null,       null),
			array($time + WEEK_IN_SECONDS,   null,       null),
			array($time + YEAR_IN_SECONDS,   null,       null),
		);

		$this->variants = $variants;
		$this->position = 0;
	}
}
