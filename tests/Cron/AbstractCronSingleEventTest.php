<?php
namespace Korobochkin\WPKit\Tests\Cron;

use Korobochkin\WPKit\Cron\AbstractCronSingleEvent;
use Korobochkin\WPKit\Tests\DataSets\Cron\CronEventDataSet;

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

	/**
	 * Test schedule event.
	 *
	 * @dataProvider casesSchedule
	 *
	 * @param $time int Timestamp to test with.
	 * @param $resultOfScheduling mixed Result which returns schedule method.
	 */
	public function testSchedule($time, $resultOfScheduling) {
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
		$this->assertEquals($resultOfScheduling, $this->stub->schedule());
		$this->assertEquals($name, $this->stub->getName());

		// And finally validate that this event added to WordPress
		$tasks = _get_cron_array();
			$this->assertTrue(isset($tasks[$time][$name]));
			$this->assertNotEmpty($tasks[$time][$name]);
			$this->assertEquals(1, count($tasks[$time][$name]));
		/*if($resultOfScheduling === null) {
		} else {
			$this->assertFalse(isset($tasks[$time][$name]));
		}*/
	}

	public function casesSchedule() {
		return new CronEventDataSet();
	}

	/**
	 * Test un-schedule single event with name.
	 *
	 * @dataProvider casesUnSchedule
	 *
	 * @param $time int Timestamp to test with.
	 * @param $resultOfScheduling mixed Result which returns schedule method.
	 */
	public function testUnSchedule($time, $resultOfScheduling) {
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

		$this->assertEquals($resultOfScheduling, $this->stub->unSchedule());

		$tasks = _get_cron_array();
		$this->assertFalse(isset($tasks[$time][$name]));
	}

	public function casesUnSchedule() {
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
	public function testUnScheduleAll($time, $resultOfScheduling) {
		$time2 = $time + DAY_IN_SECONDS;
		$time3 = $time2 + DAY_IN_SECONDS;
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

		global $wp_version;
		$result = version_compare($wp_version, '4.1');
		if($result >= 0) {
			// Do not check this if WordPress lower 4.1 because this versions have a bugs
			$tasks = _get_cron_array();
			if($resultOfScheduling === null) {
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

	public function casesUnScheduleAll() {
		return new CronEventDataSet();
	}

	public function testImmediately() {
		$time = time();
		$this->assertEquals($this->stub, $this->stub->immediately());
		$this->assertEquals($time, $this->stub->getTimestamp());
	}
}
