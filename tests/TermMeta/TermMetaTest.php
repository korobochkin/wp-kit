<?php
namespace Korobochkin\WPKit\Tests\TermMeta;

use Korobochkin\WPKit\TermMeta\TermMeta;
use Korobochkin\WPKit\Utils\WordPressFeatures;

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
        if (!WordPressFeatures::isTermsMetaSupported()) {
            // Skip tests on WP bellow 4.4 since it doesn't have required functions.
            $this->markTestSkipped('Term meta features not supported in WordPress bellow 4.4');
        }

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
