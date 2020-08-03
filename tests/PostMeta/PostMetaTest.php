<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\PostMeta;

use Korobochkin\WPKit\PostMeta\PostMeta;

/**
 * Class PostMetaTest
 * @package Korobochkin\WPKit\Tests\PostMeta
 *
 * @group data-components
 */
class PostMetaTest extends \WP_UnitTestCase
{
    /**
     * @var PostMeta
     */
    protected $stub;

    /**
     * Prepare option for tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->stub = new PostMeta();
    }

    /**
     * Dummy post meta always returns null as Constraint.
     */
    public function testBuildConstraint()
    {
        $this->assertSame(null, $this->stub->buildConstraint());
    }
}
