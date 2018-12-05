<?php
namespace Korobochkin\WPKit\Tests\Cron;

use Korobochkin\WPKit\Cron\AbstractCronEvent;

class AbstractCronEventTest extends \WP_UnitTestCase
{
    /**
     * @var AbstractCronEvent
     */
    protected $stub;

    /**
     * Prepare stub for tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForAbstractClass(AbstractCronEvent::class);
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
        $this->setExpectedException(\LogicException::class, 'You must specify valid timestamp of event before schedule.');
        $this->stub->schedule();
    }

    public function testScheduleWrongName()
    {
        $this->stub->setTimestamp(time() + HOUR_IN_SECONDS);
        $this->setExpectedException(\LogicException::class, 'You must specify name for event before schedule.');
        $this->stub->schedule();
    }

    public function testScheduleWrongRecurrence()
    {
        $this->stub->setTimestamp(time() + HOUR_IN_SECONDS);
        $this->stub->setName('wp_kit_test_cron_event');
        $this->setExpectedException(\LogicException::class, 'Invalid recurrence name. You should register before using.');
        $this->stub->schedule();
    }

    public function testSchedule()
    {
        $time       = time() + HOUR_IN_SECONDS;
        $name       = 'wp_kit_test_cron_event';
        $recurrence = 'hourly';

        $this->stub->setTimestamp($time)->setName($name)->setRecurrence($recurrence);

        $this->assertTrue($this->stub->schedule());

        $tasks = _get_cron_array();

        $this->assertTrue(isset($tasks[$time][$name]));
        $this->assertNotEmpty($tasks[$time][$name]);
        $this->assertSame(1, count($tasks[$time][$name]));

        reset($tasks);
        $firstIndex = key($tasks[$time][$name]);
        $this->assertSame($recurrence, $tasks[$time][$name][$firstIndex]['schedule']);
    }
}
