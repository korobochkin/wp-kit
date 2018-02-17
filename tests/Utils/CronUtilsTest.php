<?php
namespace Korobochkin\WPKit\Tests\Utils;

use Korobochkin\WPKit\Utils\CronUtils;

/**
 * Class CronUtilsTest
 */
class CronUtilsTest extends \WP_UnitTestCase
{
    public function testUnscheduleHook()
    {
        $time = time();
        wp_schedule_event($time, 'daily', 'wp_kit_test_event');
        wp_schedule_event($time, 'daily', 'wp_kit_test_event', array('wp_kit' => 'test'));

        $time2 = $time + WEEK_IN_SECONDS;
        wp_schedule_event($time2, 'daily', 'wp_kit_test_event');

        $crons = _get_cron_array();

        $this->assertArrayHasKey($time, $crons);
        $this->assertArrayHasKey($time2, $crons);

        CronUtils::unscheduleHook('wp_kit_test_event');

        $crons = _get_cron_array();

        foreach ($crons as $timestamp => $events) {
            $this->assertNotEquals($time, $timestamp);
            $this->assertNotEquals($time2, $timestamp);
            $this->assertArrayNotHasKey('wp_kit_test_event', $events);
        }
    }
}
