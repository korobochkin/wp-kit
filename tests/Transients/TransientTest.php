<?php
namespace Korobochkin\WPKit\Tests\Transients;

use Korobochkin\WPKit\Transients\Transient;

/**
 * Class TransientTest
 * @package Korobochkin\WPKit\Tests\Transients
 *
 * @group data-components
 */
class TransientTest extends \WP_UnitTestCase
{
    /**
     * @var Transient
     */
    protected $transient;

    /**
     * Prepare transient for tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->transient = new Transient();
    }

    /**
     * Dummy trait always returns null as Constraint.
     */
    public function testBuildConstraint()
    {
        $this->assertEquals(null, $this->transient->buildConstraint());
    }
}
