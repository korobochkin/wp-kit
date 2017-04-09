<?php
namespace Korobochkin\WPKit\Tests\Options;

use Korobochkin\WPKit\Options\Option;
use Korobochkin\WPKit\Tests\DataSets\DifferentTypesSet;

class OptionTest extends \WP_UnitTestCase {

	/**
	 * @var Option
	 */
	protected $stub;

	/**
	 * Prepare option for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = new Option();
	}

	/**
	 * Dummy option always returns null as Constraint.
	 */
	public function testBuildConstraint() {
		$this->assertEquals(null, $this->stub->buildConstraint());
	}

	/**
	 * Test Getter and Setter.
	 *
	 * @dataProvider casesDefaultValue
	 *
	 * @param $value mixed Any variable types.
	 */
	public function testDefaultValue($value) {
		$this->assertEquals($this->stub, $this->stub->setDefaultValue($value));
		$this->assertEquals($value, $this->stub->getDefaultValue());
	}

	public function casesDefaultValue() {
		return new DifferentTypesSet();
	}

	/**
	 * Test deleting local value.
	 *
	 * @dataProvider casesDeleteLocalValue
	 *
	 * @param $value mixed Any variable types.
	 */
	public function testDeleteLocalValue($value) {
		$this->assertEquals($this->stub, $this->stub->setLocalValue($value));
		$this->assertTrue($this->stub->deleteLocal());
		$this->assertNull($this->stub->getLocalValue());
	}

	public function casesDeleteLocalValue() {
		return new DifferentTypesSet();
	}
}
