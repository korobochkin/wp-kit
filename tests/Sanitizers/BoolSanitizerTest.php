<?php
namespace Korobochkin\WPKit\Tests\Sanitizers;

use Korobochkin\WPKit\Sanitizers\BoolSanitizer;

class BoolSanitizerTest extends \WP_UnitTestCase {

	/**
	 * @dataProvider additionProvider
	 */
	public function testSanitize($testIt, $expected) {
		$this->assertEquals(BoolSanitizer::sanitize($testIt), $expected);
	}

	public function additionProvider() {
		return array(
			array(true,        true),
			array(false,       false),

			array(1234,        true),
			array(0,           false),
			array(-1234,       true),
			array(PHP_INT_MAX, true),
			array(PHP_INT_MIN, true),

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

			array(array(),     true),
			array(array(1),    true),
			array(array(1, 2), true),
			array(array(''),   true),
			array(array('1'),  true),
			array(array('0'),  true),

			array(new \stdClass(), true),
			array(new \WP_Query(), true),

			array(NULL,        false)
		);
	}
}
