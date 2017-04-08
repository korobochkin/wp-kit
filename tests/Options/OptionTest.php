<?php
namespace Korobochkin\WPKit\Tests\Options;

use Korobochkin\WPKit\Options\Option;
use Korobochkin\WPKit\Tests\DataSets\DifferentTypesSet;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Form\Extension\Core\DataTransformer\BooleanToStringTransformer;
use Symfony\Component\Form\ReversedTransformer;

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
	 * Test Getter and Setter for Constraint
	 *
	 * @dataProvider casesConstraint
	 *
	 * @param $value \Symfony\Component\Validator\Constraint[]|\Symfony\Component\Validator\Constraint
	 */
	public function testConstraint($value) {
		$this->assertEquals($this->stub, $this->stub->setConstraint($value));
		$this->assertEquals($value, $this->stub->getConstraint());
	}

	public function casesConstraint() {
		return array(
			array(new Constraints\Blank()),
			array(new Constraints\NotNull()),
			array(array(
				new Constraints\Blank(),
				new Constraints\NotNull(),
			)),
		);
	}

	/**
	 * Test Getter and Setter for Data Transformers
	 *
	 * @dataProvider casesTransformer
	 *
	 * @param $value
	 */
	public function testTransformer($value) {
		$this->assertEquals($this->stub, $this->stub->setDataTransformer($value));
		$this->assertEquals($value, $this->stub->getDataTransformer());
	}

	public function casesTransformer() {
		return array(
			array(new BooleanToStringTransformer('1')),
			array(new ReversedTransformer(new BooleanToStringTransformer('1'))),
		);
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

	/**
	 * Test deleting value in WordPress.
	 *
	 * @dataProvider casesDelete
	 *
	 * @param $value mixed Any variable types.
	 * @param $expectedDeletingResult bool Result of deleting operation.
	 */
	public function testDelete($value, $expectedDeletingResult) {
		$this->stub
			->set($value)
			->setName('wp_kit_dummy_option')
			->flush();
		$this->assertEquals($expectedDeletingResult, $this->stub->delete());
		$this->assertFalse($this->stub->getValueFromWordPress());
	}

	public function casesDelete() {
		$values = array(
			array(true, true), // 0
			array(false, false), // 1

			array(1234, true), // 2
			array(0, true), // 3
			array(-1234, true), // 4
			array(PHP_INT_MAX, true), // 5
			//array(PHP_INT_MIN, true),

			array(1.234, true), // 6
			array(1.2e3, true), // 7
			array(7E-10, true), // 8
			array(-1.234, true), // 9
			array(-1.2e3, true), // 10
			array(-7E-10, true), // 11

			array('1', true), // 12
			array('VALUE', true), // 13
			array('true', true), // 14
			array('false', true), // 15
			array('', true), // 16
			array('0', true), // 17

			array(array(), true), // 18
			array(array(1), true), // 19
			array(array(1, 2), true), // 20
			array(array(''), true), // 21
			array(array('1'), true), // 22
			array(array('0'), true), // 23

			array(new \stdClass(), true), // 24
			array(new \WP_Query(), true), // 25

			array(NULL, false), // 26
		);

		// Only for PHP 7
		if(PHP_VERSION_ID >= 70000) {
			$values[] = array(PHP_INT_MIN); // 27
		}

		return $values;
	}
}
