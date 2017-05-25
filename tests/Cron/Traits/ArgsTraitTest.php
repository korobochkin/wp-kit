<?php
namespace Korobochkin\WPKit\Tests\Cron\Traits;

use Korobochkin\WPKit\Cron\Traits\ArgsTrait;

class ArgsTraitTest extends \WP_UnitTestCase {

	/**
	 * @var ArgsTrait
	 */
	protected $stub;

	/**
	 * Prepare stub for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = $this->getMockForAbstractClass(ArgsTrait::class);
	}

	public function testStub() {
		$defaultValue = array();

		$this->assertEquals($defaultValue, $this->stub->getArgs());

		$value = array(1, 2, 3);

		$this->assertEquals($this->stub, $this->stub->setArgs($value));

		$this->assertEquals($value, $this->stub->getArgs());
	}
}
