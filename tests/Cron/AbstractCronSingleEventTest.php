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
}
