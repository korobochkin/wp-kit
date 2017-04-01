<?php
namespace Korobochkin\WPKit\Tests\Options\Special;

use Korobochkin\WPKit\Options\Special\DateTimeOption;
use Symfony\Component\Form\Exception\TransformationFailedException;

class DateTimeOptionTest extends \WP_UnitTestCase {

	/**
	 * @var DateTimeOption
	 */
	protected $option;

	/**
	 * Prepare option for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->option = new DateTimeOption();
		$this->option->setName('wp_kit_datetime_option');
	}

	/**
	 * @dataProvider getDataCases
	 * @var $value mixed Value to insert and test.
	 * @var $expected mixed Value to compare output value with.
	 */
	public function testTypes($value, $expected) {
		$this->option->set($value);

		if(is_a($expected, \DateTime::class)) {
			$this->option->flush();
			$this->assertEquals($expected, $this->option->get());
		} else {
			if(method_exists($this, 'expectException')) {
				$this->expectException($expected);
				$this->option->flush();
			} else {
				try {
					$this->option->flush();
				}
				catch(\Exception $exception) {
					$this->assertTrue(is_a($exception, $expected));
				}
			}
		}
	}

	public function testNull() {
		$this->option->set(null);
		$this->assertEquals('', $this->option->get());
	}

	public function getDataCases() {
		$now = new \DateTime();
		$values = array(
			array($now, $now),

			array(true,        TransformationFailedException::class),
			array(false,       TransformationFailedException::class),

			array(1234,        TransformationFailedException::class),
			array(0,           TransformationFailedException::class),
			array(-1234,       TransformationFailedException::class),
			array(PHP_INT_MAX, TransformationFailedException::class),
			//array(PHP_INT_MIN, true),

			array(1.234,       TransformationFailedException::class),
			array(1.2e3,       TransformationFailedException::class),
			array(7E-10,       TransformationFailedException::class),
			array(-1.234,      TransformationFailedException::class),
			array(-1.2e3,      TransformationFailedException::class),
			array(-7E-10,      TransformationFailedException::class),

			array('1',         TransformationFailedException::class),
			array('VALUE',     TransformationFailedException::class),
			array('true',      TransformationFailedException::class),
			array('false',     TransformationFailedException::class),
			array('',          TransformationFailedException::class),
			array('0',         TransformationFailedException::class),

			array(array(),     TransformationFailedException::class),
			array(array(1),    TransformationFailedException::class),
			array(array(1, 2), TransformationFailedException::class),
			array(array(''),   TransformationFailedException::class),
			array(array('1'),  TransformationFailedException::class),
			array(array('0'),  TransformationFailedException::class),

			array(new \stdClass(), TransformationFailedException::class),
			array(new \WP_Query(), TransformationFailedException::class),

			//array(NULL,        ''), // null tested in separated test
		);

		// Only for PHP 7
		$result = version_compare(phpversion(), '7');
		if($result == 0 || $result == 1) {
			$values[] = array(PHP_INT_MIN, TransformationFailedException::class);
		}

		return $values;
	}
}
