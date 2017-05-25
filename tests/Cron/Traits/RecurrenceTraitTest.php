<?php
namespace Korobochkin\WPKit\Tests\Cron\Traits;

use Korobochkin\WPKit\Cron\Traits\RecurrenceTrait;

class RecurrenceTraitTest extends \WP_UnitTestCase {

	/**
	 * @var RecurrenceTrait
	 */
	protected $stub;

	/**
	 * Prepare stub for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = $this->getMockForTrait(RecurrenceTrait::class);
	}

	public function testStub() {
		$defaultValue = 'hourly';

		$this->assertEquals($defaultValue, $this->stub->getRecurrence());

		$value = 'daily';

		$this->assertEquals($this->stub, $this->stub->setRecurrence($value));

		$this->assertEquals($value, $this->stub->getRecurrence());
	}
}
