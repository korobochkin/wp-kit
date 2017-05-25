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

		$this->stub->setTimestamp(time());

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

		$this->stub->setHook('__return_true');
		$this->assertNull($this->stub->schedule());


	}
}
