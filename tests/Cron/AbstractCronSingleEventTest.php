<?php
namespace Korobochkin\WPKit\Tests\Cron;

use Korobochkin\WPKit\Cron\AbstractCronSingleEvent;

class AbstractCronSingleEventTest extends \WP_UnitTestCase {

	/**
	 * @var AbstractCronSingleEvent
	 */
	protected $stub;

	/**
	 * Prepare stub for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = $this->getMockForAbstractClass(AbstractCronSingleEvent::class);
	}

	public function testSchedule() {
		$time = time();
		$name = 'wp_kit_test_cron_event';
		$tasks = _get_cron_array();

		$this->assertFalse(isset($tasks[$time][$name]));

		// Set wrong timestamp
		$this->stub->setTimestamp('123');

		if(PHP_VERSION_ID >= 70000) {
			// PHP 7
			$this->expectException(\LogicException::class);
			$this->stub->schedule();
		} else {
			// PHP 5
			try {
				$this->stub->schedule();
			}
			catch(\Exception $exception) {
				$this->assertTrue(is_a($exception, \LogicException::class));
			}
		}

		$this->stub->setTimestamp($time);

		if(PHP_VERSION_ID >= 70000) {
			// PHP 7
			$this->expectException(\LogicException::class);
			$this->stub->schedule();
		} else {
			// PHP 5
			try {
				$this->stub->schedule();
			}
			catch(\Exception $exception) {
				$this->assertTrue(is_a($exception, \LogicException::class));
			}
		}

		$this->stub->setName($name);
		$this->assertNull($this->stub->schedule());
		$this->assertEquals($name, $this->stub->getName());

		// And finally validate that this event added to WordPress
		$tasks = _get_cron_array();
		$this->assertTrue(isset($tasks[$time][$name]));
		$this->assertNotEmpty($tasks[$time][$name]);
		$this->assertEquals(1, count($tasks[$time][$name]));
	}

	public function testUnSchedule() {
		$time = time();
		$name = 'wp_kit_test_cron_event';
		$tasks = _get_cron_array();

		// Add event
		$this->stub
			->setTimestamp($time)
			->setName($name)
			->schedule();

		// Reset values of object to default
		$this->stub
			->setTimestamp('123')
			->setName(null);

		if(PHP_VERSION_ID >= 70000) {
			// PHP 7
			$this->expectException(\LogicException::class);
			$this->stub->unSchedule();
		} else {
			// PHP 5
			try {
				$this->stub->unSchedule();
			}
			catch(\Exception $exception) {
				$this->assertTrue(is_a($exception, \LogicException::class));
			}
		}

		$this->stub->setTimestamp($time);

		if(PHP_VERSION_ID >= 70000) {
			// PHP 7
			$this->expectException(\LogicException::class);
			$this->stub->unSchedule();
		} else {
			// PHP 5
			try {
				$this->stub->unSchedule();
			}
			catch(\Exception $exception) {
				$this->assertTrue(is_a($exception, \LogicException::class));
			}
		}

		$this->stub->setName($name);

		$this->assertNull($this->stub->unSchedule());

		$tasks = _get_cron_array();
		$this->assertFalse(isset($tasks[$time][$name]));
	}

	public function testUnScheduleAll() {
		$time = time();
		$time2 = $time + HOUR_IN_SECONDS;
		$time3 = $time2 + HOUR_IN_SECONDS;
		$name = 'wp_kit_test_cron_event';

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

		$tasks = _get_cron_array();
		$this->assertTrue(isset($tasks[$time][$name]));
		$this->assertTrue(isset($tasks[$time2][$name]));
		$this->assertTrue(isset($tasks[$time3][$name]));

		$this->stub->unScheduleAll();
		$tasks = _get_cron_array();
		$this->assertFalse(isset($tasks[$time][$name]));
		$this->assertFalse(isset($tasks[$time2][$name]));
		$this->assertFalse(isset($tasks[$time3][$name]));
	}

	public function testImmediately() {
		$time = time();
		$this->assertEquals($this->stub, $this->stub->immediately());
		$this->assertEquals($time, $this->stub->getTimestamp());
	}
}
