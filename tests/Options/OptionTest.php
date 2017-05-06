<?php
namespace Korobochkin\WPKit\Tests\Options;

use Korobochkin\WPKit\Options\Option;

/**
 * Class OptionTest
 * @package Korobochkin\WPKit\Tests\Options
 *
 * @group data-components
 */
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
}
