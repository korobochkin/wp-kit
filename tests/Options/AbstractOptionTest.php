<?php
namespace Korobochkin\WPKit\Tests\Options;

use Korobochkin\WPKit\Options\Option;
use Korobochkin\WPKit\Tests\DataSets\AfterDeletionSet;
use Korobochkin\WPKit\Tests\DataSets\AfterSavingSet;
use Korobochkin\WPKit\Tests\DataSets\DifferentTypesSet;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Form\Extension\Core\DataTransformer\BooleanToStringTransformer;
use Symfony\Component\Form\ReversedTransformer;

class AbstractOptionTest extends \WP_UnitTestCase {

	/**
	 * @var Option
	 */
	protected $stub;

	/**
	 * Prepare option for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = $this->getMockForAbstractClass(Option::class);
	}

	/**
	 * Test without setting name.
	 */
	public function testGetValueFromWordPress() {
		if(PHP_VERSION_ID >= 70000) {
			// PHP 7
			$this->expectException(\LogicException::class);
			$this->stub->getValueFromWordPress();
		} else {
			// PHP 5
			try {
				$this->stub->getValueFromWordPress();
			}
			catch(\Exception $exception) {
				$this->assertTrue(is_a($exception, \LogicException::class));
			}
		}
	}

	/**
	 * Test with setting name before request value.
	 */
	public function testGetValueFromWordPressWithName() {
		$this->stub->setName('wp_kit_abstract_option');
		$this->assertFalse($this->stub->getValueFromWordPress());
	}

	/**
	 * @dataProvider casesAutoload
	 */
	public function testAutoload($value, $expected) {
		$this->stub->setName('wp_kit_abstract_option');
		$this->assertEquals($expected, $this->stub->setAutoload($value)->isAutoload());
	}

	public function casesAutoload() {
		$values = array(
			array(true,        true),
			array(false,       false),

			array(1234,        true),
			array(0,           false),
			array(-1234,       true),
			array(PHP_INT_MAX, true),
			//array(PHP_INT_MIN, true),

			array(1.234,       true),
			array(1.2e3,       true),
			array(7E-10,       true),
			array(-1.234,      true),
			array(-1.2e3,      true),
			array(-7E-10,      true),

			array('1',         true),
			array('VALUE',     true),
			array('true',      true),
			array('false',     true),
			array('',          false),
			array('0',         false),

			array(array(),     false),
			array(array(1),    true),
			array(array(1, 2), true),
			array(array(''),   true),
			array(array('1'),  true),
			array(array('0'),  true),

			array(new \stdClass(), true),
			array(new \WP_Query(), true),

			array(NULL,        false)
		);

		// Only for PHP 7
		if(PHP_VERSION_ID >= 70000) {
			$values[] = array(PHP_INT_MIN, true);
		}

		return $values;
	}

	/**
	 * Test deleting value in WordPress.
	 *
	 * @dataProvider casesDeleteFromWP
	 *
	 * @param $value mixed Any variable types.
	 * @param $expectedDeletingResult bool Result of deleting operation.
	 */
	public function testDeleteFromWP($value, $expectedDeletingResult) {
		// Without name throwing an error
		if(PHP_VERSION_ID >= 70000) {
			// PHP 7
			$this->expectException(\LogicException::class);
			$this->stub->deleteFromWP();
		} else {
			// PHP 5
			try {
				$this->stub->deleteFromWP();
			}
			catch(\Exception $exception) {
				$this->assertTrue(is_a($exception, \LogicException::class));
			}
		}

		// Load value into WordPress
		$this->stub
			->setName('wp_kit_abstract_option')
			->updateValue($value);

		// Check that successful remove from DB
		$this->assertEquals($expectedDeletingResult, $this->stub->deleteFromWP());
		$this->assertFalse($this->stub->getValueFromWordPress());
	}

	public function casesDeleteFromWP() {
		return new AfterDeletionSet();
	}

	/**
	 * Test flushing (saving) values into WordPress.
	 *
	 * @dataProvider casesFlush
	 *
	 * @param $value mixed Any variable types.
	 * @param $expectedFlushingResult bool Expected result of flushing (saving).
	 * @param $expectedValue mixed Expected value from WordPress
	 */
	public function testFlush($value, $expectedFlushingResult, $expectedValue) {
		$this->assertTrue($this->stub->flush());

		$this->stub->set($value);

		if(PHP_VERSION_ID >= 70000) {
			// PHP 7
			$this->expectException(\LogicException::class);
			$this->stub->flush();
		} else {
			// PHP 5
			try {
				$this->stub->flush();
			}
			catch(\Exception $exception) {
				$this->assertTrue(is_a($exception, \LogicException::class));
			}
		}

		$this->stub->setName('wp_kit_abstract_option');

		// Successful saved
		$this->assertEquals($expectedFlushingResult, $this->stub->flush());

		// Retrieve value back
		$this->assertEquals($expectedValue, $this->stub->get());

		// Local value deleted
		$this->assertEquals(null, $this->stub->getLocalValue());
	}

	public function casesFlush() {
		return new AfterSavingSet();
	}

	/**
	 * Test flushing (saving) values into WordPress.
	 *
	 * @dataProvider casesUpdateValue
	 *
	 * @param $value mixed Any variable types.
	 * @param $expectedFlushingResult bool Expected result of flushing (saving).
	 * @param $expectedValue mixed Expected value from WordPress
	 */
	public function testUpdateValue($value, $expectedFlushingResult, $expectedValue) {
		$this->stub
			->setName('wp_kit_abstract_option')
			->set($value);

		// Successful saved
		$this->assertEquals($expectedFlushingResult, $this->stub->flush());

		// Retrieve value back
		$this->assertEquals($expectedValue, $this->stub->get());

		// Local value deleted
		$this->assertEquals(null, $this->stub->getLocalValue());
	}

	public function casesUpdateValue() {
		return new AfterSavingSet();
	}

	/**
	 * @dataProvider casesGet
	 *
	 * @param $value
	 * @param $expectedFlushingResult
	 * @param $expectedValue
	 */
	public function testGet($value, $expectedFlushingResult, $expectedValue) {
		$this->stub->setName('wp_kit_abstract_option');

		// Check default value
		$this->assertEquals(null, $this->stub->get());

		// Check Default value again
		$this->stub->setDefaultValue($value);
		$this->assertEquals($value, $this->stub->get());

		// Check returning local value
		$this->stub->setDefaultValue(uniqid('wp_kit', true));
		$this->stub->setLocalValue($value);
		if($value === null) {
			$this->assertEquals($this->stub->getDefaultValue(), $this->stub->get());
		} else {
			$this->assertEquals($value, $this->stub->get());
		}

		// Check returning value from WordPress
		$this->stub->flush();
		// TODO: something wrong here
		$this->assertEquals($expectedValue, $this->stub->get());
	}

	public function casesGet() {
		return new AfterSavingSet();
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
}
