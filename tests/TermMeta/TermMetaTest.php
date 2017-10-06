<?php
namespace Korobochkin\WPKit\Tests\TermMeta;

use Korobochkin\WPKit\TermMeta\TermMeta;

/**
 * Class TermMetaTest
 * @package Korobochkin\WPKit\Tests\TermMeta
 *
 * @group data-components
 */
class TermMetaTest extends \WP_UnitTestCase
{
    /**
     * @var TermMeta
     */
    protected $stub;

    /**
     * Prepare option for tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->stub = new TermMeta();
    }

    /**
     * Dummy post meta always returns null as Constraint.
     */
    public function testBuildConstraint()
    {
        $this->assertEquals(null, $this->stub->buildConstraint());
    }
}
