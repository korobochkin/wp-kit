<?php
namespace Korobochkin\WPKit\Tests\Cron\Traits;

use Korobochkin\WPKit\Cron\Traits\TimestampTrait;

class TimestampTraitTest extends \WP_UnitTestCase {

	/**
	 * @var TimestampTrait
	 */
	protected $stub;

	/**
	 * Prepare stub for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = $this->getMockForTrait(TimestampTrait::class);
	}

	public function testStub() {
		$defaultValue = 0;

		$this->assertEquals($defaultValue, $this->stub->getTimestamp());

		$value = time();

		$this->assertEquals($this->stub, $this->stub->setTimestamp($value));

		$this->assertEquals($value, $this->stub->getTimestamp());
	}
}
