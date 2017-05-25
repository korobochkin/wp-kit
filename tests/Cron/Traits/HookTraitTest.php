<?php
namespace Korobochkin\WPKit\Tests\Cron\Traits;

use Korobochkin\WPKit\Cron\Traits\HookTrait;

class HookTraitTest extends \WP_UnitTestCase {

	/**
	 * @var HookTrait
	 */
	protected $stub;

	/**
	 * Prepare stub for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = $this->getMockForTrait(HookTrait::class);
	}

	public function testStub() {
		$defaultValue = 'execute';

		$this->assertEquals($defaultValue, $this->stub->getHook());

		$value = 'custom_callback';

		$this->assertEquals($this->stub, $this->stub->setHook($value));

		$this->assertEquals($value, $this->stub->getHook());
	}
}
