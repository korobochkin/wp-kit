<?php
namespace Korobochkin\WPKit\Tests\DataComponents;

use Korobochkin\WPKit\DataComponents\AbstractNode;

class AbstractNodeTest extends \WP_UnitTestCase {

	/**
	 * @var AbstractNode
	 */
	protected $stub;

	/**
	 * Prepare abstract node for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = $this->getMockForAbstractClass(AbstractNode::class);
	}
}
