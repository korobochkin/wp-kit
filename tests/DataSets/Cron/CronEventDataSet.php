<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\DataSets\Cron;

use Korobochkin\WPKit\Tests\DataSets\AbstractDataSet;

/**
 * Class CronEventDataSet
 * @package Korobochkin\WPKit\Tests\DataSets\Cron
 */
class CronEventDataSet extends AbstractDataSet
{

    /**
     * CronEventDataSet constructor.
     */
    public function __construct()
    {
        $time = time();

        $variants = array(
            // @codingStandardsIgnoreStart
            //    timestamp                  result      result
            //                               of          of
            //                               scheduling  un-scheduling
            array(1,                         null,       null),
            array($time,                     null,       null),
            array($time + MINUTE_IN_SECONDS, null,       null),
            array($time + HOUR_IN_SECONDS,   null,       null),
            array($time + DAY_IN_SECONDS,    null,       null),
            array($time + WEEK_IN_SECONDS,   null,       null),
            array($time + YEAR_IN_SECONDS,   null,       null),
            // @codingStandardsIgnoreEnd
        );

        $this->variants = $variants;
        $this->position = 0;
    }
}
