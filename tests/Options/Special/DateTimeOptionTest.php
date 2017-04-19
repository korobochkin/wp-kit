<?php
namespace Korobochkin\WPKit\Tests\Options\Special;

use Korobochkin\WPKit\Options\Special\DateTimeOption;
use Korobochkin\WPKit\Tests\DataSets\DateTimeOption\TypesTransformationSet;

class DateTimeOptionTest extends \WP_UnitTestCase {

	// TODO: fix this test

	/**
	 * @var DateTimeOption
	 */
	protected $stub;

	/**
	 * Prepare option for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = new DateTimeOption();
		$this->stub->setName('wp_kit_datetime_option');
	}

	/**
	 * @dataProvider getDataCases
	 * @var $value mixed Value to insert and test.
	 * @var $expected mixed Value to compare output value with.
	 */
	public function testTypes($value, $expected) {
		$this->stub->set($value);

		if(is_a($expected, \DateTime::class)) {
			$this->stub->flush();
			$this->assertEquals($expected, $this->stub->get());
		} else {
			if(PHP_VERSION_ID >= 70000) {
				$this->expectException($expected);
				$this->stub->flush();
			} else {
				try {
					$this->stub->flush();
				}
				catch(\Exception $exception) {
					$this->assertTrue(is_a($exception, $expected));
				}
			}
		}
	}

	public function casesTypes() {
		return new TypesTransformationSet();
	}

	public function testNull() {
		$this->stub->set(null);
		$this->assertEquals('', $this->stub->get());
	}
}
