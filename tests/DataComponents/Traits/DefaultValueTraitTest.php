<?php
namespace Korobochkin\WPKit\Tests\DataComponents\Traits;

use Korobochkin\WPKit\DataComponents\Traits\DefaultValueTrait;

class DefaultValueTraitTest extends \WP_UnitTestCase {

	/**
	 * @var DefaultValueTrait
	 */
	protected $stub;

	/**
	 * Prepare trait for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = $this->getMockForTrait(DefaultValueTrait::class);
	}

	/**
	 * Test Getter and Setter.
	 *
	 * @dataProvider casesForGetterAndSetter
	 *
	 * @param $value
	 */
	public function testGetterAndSetter($value) {
		$this->assertEquals($this->stub, $this->stub->setDefaultValue($value));
		$this->assertEquals($value, $this->stub->getDefaultValue());
	}

	public function casesForGetterAndSetter() {
		$values = array(
			array(true),
			array(false),

			array(1234),
			array(0),
			array(-1234),
			array(PHP_INT_MAX),
			//array(PHP_INT_MIN, true),

			array(1.234),
			array(1.2e3),
			array(7E-10),
			array(-1.234),
			array(-1.2e3),
			array(-7E-10),

			array('1'),
			array('VALUE'),
			array('true'),
			array('false'),
			array(''),
			array('0'),

			array(array()),
			array(array(1)),
			array(array(1, 2)),
			array(array('')),
			array(array('1')),
			array(array('0')),

			array(new \stdClass()),
			array(new \WP_Query()),

			array(NULL)
		);

		// Only for PHP 7
		$result = version_compare(phpversion(), '7');
		if($result == 0 || $result == 1) {
			$values[] = array(PHP_INT_MIN);
		}

		return $values;
	}
}
