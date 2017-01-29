<?php
namespace Korobochkin\WPKit\Tests\Sanitizers;

use Korobochkin\WPKit\Sanitizers\FloatSanitizer;

class FloatSanitizerTest extends \WP_UnitTestCase {

	/**
	 * @dataProvider additionProvider
	 */
	public function testSanitize($testIt, $expected) {
		$this->assertEquals(FloatSanitizer::sanitize($testIt), $expected);
	}

	public function additionProvider() {
		return array(
			array(true,        1.0),
			array(false,       0.0),

			array(1234,        1234.0),
			array(0,           0.0),
			array(-1234,       -1234.0),
			array(PHP_INT_MAX, 9.2233720368548E+18),
			array(PHP_INT_MIN, 0.0),

			array(1.234,       1.234),
			array(1.2e3,       1.2e3),
			array(7E-10,       7E-10),
			array(-1.234,      -1.234),
			array(-1.2e3,      -1.2e3),
			array(-7E-10,      -7E-10),

			array('1',         1.0),
			array('VALUE',     0),
			array('true',      0.0),
			array('false',     0.0),
			array('',          0.0),
			array('0',         0.0),

			array(array(),     0.0),
			array(array(1),    1.0),
			array(array(1, 2), 1.0),
			array(array(''),   1.0),
			array(array('1'),  1.0),
			array(array('0'),  1.0),

			array(new \stdClass(), 1.0),
			array(new \WP_Query(), 1.0),

			array(NULL,        0.0)
		);
	}
}
