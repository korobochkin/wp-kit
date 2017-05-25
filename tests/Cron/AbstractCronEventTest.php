<?php
namespace Korobochkin\WPKit\Tests\Cron;

use Korobochkin\WPKit\Cron\AbstractCronEvent;

class AbstractCronEventTest extends \WP_UnitTestCase {

	/**
	 * @var AbstractCronEvent
	 */
	protected $stub;

	/**
	 * Prepare stub for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = $this->getMockForAbstractClass(AbstractCronEvent::class);
	}

	public function testSchedule() {
		$this->markTestIncomplete();
	}
}
