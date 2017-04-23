<?php
namespace Korobochkin\WPKit\Tests\PostMeta;

use Korobochkin\WPKit\PostMeta\PostMeta;

class PostMetaTest extends \WP_UnitTestCase {

	/**
	 * @var PostMeta
	 */
	protected $stub;

	/**
	 * Prepare option for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = new PostMeta();
	}

	/**
	 * Dummy option always returns null as Constraint.
	 */
	public function testBuildConstraint() {
		$this->assertEquals(null, $this->stub->buildConstraint());
	}
}
