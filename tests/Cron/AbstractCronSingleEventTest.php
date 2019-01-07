<?php
namespace Korobochkin\WPKit\Tests\Cron;

use Korobochkin\WPKit\Cron\AbstractCronSingleEvent;
use Korobochkin\WPKit\Tests\DataSets\Cron\CronEventDataSet;

class AbstractCronSingleEventTest extends \WP_UnitTestCase
{
    /**
     * @var AbstractCronSingleEvent
     */
    protected $stub;

    /**
     * Prepare stub for tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForAbstractClass(AbstractCronSingleEvent::class);
    }

    public function testScheduleInitialState()
    {
        $time  = time() + HOUR_IN_SECONDS;
        $name  = 'wp_kit_test_cron_event';
        $tasks = _get_cron_array();

        $this->assertFalse(isset($tasks[$time][$name]));
    }

    public function testScheduleWrongTimeStamp()
    {
        $this->stub->setTimestamp('123');
        $this->setExpectedException(
            \LogicException::class,
            'You must specify valid timestamp of event before schedule.'
        );
        $this->stub->schedule();
    }

    public function testScheduleWrongName()
    {
        $this->stub->setTimestamp(time() + HOUR_IN_SECONDS);
        $this->setExpectedException(\LogicException::class, 'You must specify name for event before schedule.');
        $this->stub->schedule();
    }

    public function testSchedule()
    {
        $time       = time() + HOUR_IN_SECONDS;
        $name       = 'wp_kit_test_cron_event';
        $recurrence = 'hourly';

        $this->stub->setTimestamp($time)->setName($name);

        $this->assertNull($this->stub->schedule());

        $tasks = _get_cron_array();

        $this->assertTrue(isset($tasks[$time][$name]));
        $this->assertNotEmpty($tasks[$time][$name]);
        $this->assertSame(1, count($tasks[$time][$name]));
    }

    /**
     * @dataProvider casesUnSchedule
     *
     * @param $time int Timestamp to test with.
     * @param $resultOfScheduling mixed Result which returns schedule method.
     */
    public function testUnScheduleWrongTimeStamp($time, $resultOfScheduling)
    {
        $name = 'wp_kit_test_cron_event';

        $this->stub
            ->setTimestamp($time)
            ->setName($name)
            ->schedule();

        $this->stub->setTimestamp('123');

        $this->setExpectedException(
            \LogicException::class,
            'You must specify valid timestamp of event before un schedule.'
        );

        $this->stub->unSchedule();
    }

    /**
     * @dataProvider casesUnSchedule
     *
     * @param $time int Timestamp to test with.
     * @param $resultOfScheduling mixed Result which returns schedule method.
     */
    public function testUnScheduleWrongName($time, $resultOfScheduling)
    {
        $name = 'wp_kit_test_cron_event';

        $this->stub
            ->setTimestamp($time)
            ->setName($name)
            ->schedule();

        $this->stub->setName(null);

        $this->setExpectedException(
            \LogicException::class,
            'You must specify name for event before un schedule.'
        );

        $this->stub->unSchedule();
    }

    /**
     * @dataProvider casesUnSchedule
     *
     * @param $time int Timestamp to test with.
     * @param $resultOfScheduling mixed Result which returns schedule method.
     */
    public function testUnSchedule($time, $resultOfScheduling)
    {
        $name = 'wp_kit_test_cron_event';

        $this->stub
            ->setTimestamp($time)
            ->setName($name)
            ->schedule();

        $this->assertSame($resultOfScheduling, $this->stub->unSchedule());

        $tasks = _get_cron_array();
        $this->assertFalse(isset($tasks[$time][$name]));
    }

    public function casesUnSchedule()
    {
        return new CronEventDataSet();
    }

    /**
     * Test un-scheduling all events with same name.
     *
     * Scheduling events close to each other may have a bugs in older WordPress versions
     *
     * @see https://core.trac.wordpress.org/ticket/28213 Bug in WordPress < 4.1
     *
     * @dataProvider casesUnScheduleAll
     *
     * @param $time int Timestamp to test with.
     * @param $resultOfScheduling mixed Result which returns schedule method.
     */
    public function testUnScheduleAll($time, $resultOfScheduling)
    {
        $time2 = $time + DAY_IN_SECONDS;
        $time3 = $time2 + DAY_IN_SECONDS;
        $name  = 'wp_kit_test_cron_event';

        $this->stub
            ->setName($name);

        $this->stub
            ->setTimestamp($time)
            ->schedule();

        $this->stub
            ->setTimestamp($time2)
            ->schedule();

        $this->stub
            ->setTimestamp($time3)
            ->schedule();

        global $wp_version;
        $result = version_compare($wp_version, '4.1');
        if ($result >= 0) {
            // Do not check this if WordPress lower 4.1 because this versions have a bugs.
            $tasks = _get_cron_array();
            if ($resultOfScheduling === null) {
                $this->assertTrue(isset($tasks[$time][$name]));
                $this->assertTrue(isset($tasks[$time2][$name]));
                $this->assertTrue(isset($tasks[$time3][$name]));
            } else {
                $this->assertFalse(isset($tasks[$time][$name]));
                $this->assertTrue(isset($tasks[$time2][$name]));
                $this->assertTrue(isset($tasks[$time3][$name]));
            }
        }

        $this->stub->unScheduleAll();
        $tasks = _get_cron_array();
        $this->assertFalse(isset($tasks[$time][$name]));
        $this->assertFalse(isset($tasks[$time2][$name]));
        $this->assertFalse(isset($tasks[$time3][$name]));
    }

    public function casesUnScheduleAll()
    {
        return new CronEventDataSet();
    }

    public function testImmediately()
    {
        $time = time();
        $this->assertSame($this->stub, $this->stub->immediately());
        $this->assertSame($time, $this->stub->getTimestamp());
    }

    /**
     * @dataProvider casesIsScheduled
     *
     * @param $time int Timestamp to test with.
     * @param $resultOfScheduling mixed Result which returns schedule method.
     */
    public function testIsScheduled($time, $resultOfScheduling)
    {
        $this->stub->setName('wp_kit_test_cron_event')->setTimestamp($time)->schedule();
        $this->assertTrue($this->stub->isScheduled());
    }

    /**
     * @return CronEventDataSet
     */
    public function casesIsScheduled()
    {
        return new CronEventDataSet();
    }

    public function testIsScheduledNotScheduled()
    {
        $this->stub->setName('wp_kit_test_cron_event');
        $this->assertFalse($this->stub->isScheduled());
    }
}
