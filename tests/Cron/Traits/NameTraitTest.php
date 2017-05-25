<?php
namespace Korobochkin\WPKit\Tests\Cron\Traits;

use Korobochkin\WPKit\Cron\Traits\NameTrait;

class NameTraitTest extends \WP_UnitTestCase {

	/**
	 * @var NameTrait
	 */
	protected $stub;

	/**
	 * Prepare stub for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = $this->getMockForTrait(NameTrait::class);
	}

	public function testStub() {
		$defaultValue = null;

		$this->assertEquals($defaultValue, $this->stub->getName());

		$value = 'wp_kit_test_name';

		$this->assertEquals($this->stub, $this->stub->setName($value));

		$this->assertEquals($value, $this->stub->getName());
	}
}
