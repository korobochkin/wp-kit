<?php
namespace Korobochkin\WPKit\Tests\Cron;

use Korobochkin\WPKit\Cron\AbstractCronEvent;

/**
 * Class AbstractCronEventTest
 * @package Korobochkin\WPKit\Tests\Cron
 */
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

    public function testSchedule()
    {
        $time       = time() + HOUR_IN_SECONDS;
        $name       = 'wp_kit_test_cron_event';
        $recurrence = 'hourly';
        $tasks      = _get_cron_array();

        $this->assertFalse(isset($tasks[$time][$name]));

        // Set wrong timestamp.
        $this->stub->setTimestamp('123');
        $this->stub->setRecurrence('NOT_EXISTS');

        if (PHP_VERSION_ID >= 70000) {
            // PHP 7.
            $this->expectException(\LogicException::class);
            $this->stub->schedule();
        } else {
            // PHP 5.
            try {
                $this->stub->schedule();
            } catch (\Exception $exception) {
                $this->assertTrue(is_a($exception, \LogicException::class));
            }
        }

        $this->stub->setTimestamp($time);

        if (PHP_VERSION_ID >= 70000) {
            // PHP 7.
            $this->expectException(\LogicException::class);
            $this->stub->schedule();
        } else {
            // PHP 5.
            try {
                $this->stub->schedule();
            } catch (\Exception $exception) {
                $this->assertTrue(is_a($exception, \LogicException::class));
            }
        }

        $this->stub->setRecurrence($recurrence);

        if (PHP_VERSION_ID >= 70000) {
            // PHP 7.
            $this->expectException(\LogicException::class);
            $this->stub->schedule();
        } else {
            // PHP 5.
            try {
                $this->stub->schedule();
            } catch (\Exception $exception) {
                $this->assertTrue(is_a($exception, \LogicException::class));
            }
        }

        $this->stub->setName($name);
        $this->assertNull($this->stub->schedule());
        $this->assertSame($name, $this->stub->getName());

        // And finally validate that this event added to WordPress.
        $tasks = _get_cron_array();
        $this->assertTrue(isset($tasks[$time][$name]));
        $this->assertNotEmpty($tasks[$time][$name]);
        $this->assertSame(1, count($tasks[$time][$name]));

        reset($tasks);
        $firstIndex = key($tasks[$time][$name]);
        $this->assertSame($recurrence, $tasks[$time][$name][$firstIndex]['schedule']);
    }
}
