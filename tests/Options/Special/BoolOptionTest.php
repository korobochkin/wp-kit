<?php
namespace Korobochkin\WPKit\Tests\Options\Special;

use Korobochkin\WPKit\Options\Special\BoolOption;
use Symfony\Component\Form\Exception\TransformationFailedException;

class BoolOptionTest extends \WP_UnitTestCase {

	/**
	 * @var BoolOption
	 */
	protected $option;

	public function setUp() {
		parent::setUp();
		$this->option = new BoolOption();
	}

	/**
	 * @dataProvider getDataCases
	 */
	public function testAlwaysGetBoolAfterSaving($value, $expected) {
		$this->option
			->set($value);

		if(class_exists($expected)) {
			$this->expectException($expected);
			$this->option->flush();
		} else {
			$this->option->flush();
			$this->assertEquals($expected, $this->option->get());
		}
	}

	public function testAlwaysGetBoolWithoutSaving($value, $expected) {
		$this->option->set($value);

		if(class_exists($expected)) {
			$this->assertEquals($value, $this->option->get());
		} else {
			$this->assertEquals($expected, $this->option->get());
		}
	}

	/*public function testAlwaysGetBoolWithNoValue() {
		$this->assertEquals(false, $this->option->get());
	}*/

	public function getDataCases() {
		$values = array(
			array(true,        true),
			array(false,       false),

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

			array(NULL,        NULL)
		);

		// Only for PHP 7
		$result = version_compare(phpversion(), '7');
		if($result == 0 || $result == 1) {
			$values[] = array(PHP_INT_MIN, TransformationFailedException::class);
		}

		return $values;
	}
}
