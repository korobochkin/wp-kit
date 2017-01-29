<?php
namespace Korobochkin\WPKit\Tests\Sanitizers;

use Korobochkin\WPKit\Sanitizers\IntegerSanitizer;

class IntegerSanitizerTest extends \WP_UnitTestCase {

	/**
	 * @dataProvider additionProvider
	 */
	public function testSanitize($testIt, $expected) {
		$this->assertEquals(IntegerSanitizer::sanitize($testIt), $expected);
	}

	public function additionProvider() {
		$values = array(
			array(true,        1),
			array(false,       0),

			array(1234,        1234),
			array(0,           0.0),
			array(-1234,       -1234),
			array(PHP_INT_MAX, PHP_INT_MAX),
			//array(PHP_INT_MIN, PHP_INT_MIN),

			array(1.234,       1),
			array(1.2e3,       1200),
			array(7E-10,       0),
			array(-1.234,      -1),
			array(-1.2e3,      -1200),
			array(-7E-10,      0),

			array('1',         1),
			array('VALUE',     0),
			array('true',      0),
			array('false',     0),
			array('',          0),
			array('0',         0),

			array(array(),     0),
			array(array(1),    1),
			array(array(1, 2), 1),
			array(array(''),   1),
			array(array('1'),  1),
			array(array('0'),  1),

			array(new \stdClass(), 1),
			array(new \WP_Query(), 1),

			array(NULL,        0)
		);

		// Only for PHP 7
		$result = version_compare(phpversion(), '7');
		if($result == 0 || $result == 1) {
			$values[] = array(PHP_INT_MIN, PHP_INT_MIN);
		}

		return $values;
	}
}
