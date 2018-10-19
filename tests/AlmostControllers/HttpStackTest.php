<?php
namespace Korobochkin\WPKit\Tests\AlmostControllers;

use Korobochkin\WPKit\AlmostControllers\HttpStack;
use Korobochkin\WPKit\Tests\DataSets\AlmostControllers\TestAction;

class HttpStackTest extends \WP_UnitTestCase
{
    /**
     * @var HttpStack
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();

        $this->stub = new HttpStack(array(), 'wp_kit_test_action_name');
    }

    public function testRegister()
    {
        $this->setExpectedException(\LogicException::class, 'You need set actions before call register method.');
        $this->stub->register();

        $this->setExpectedException(null);

        $actions = array(
            new TestAction(),
        );

        $this->stub
            ->setActions($actions)
            ->register();

        $this->assertTrue(has_filter('admin_post_wp_kit_test_action_name', array($this->stub, 'handleRequest')));
        $this->assertTrue(has_filter('admin_post_nopriv_wp_kit_test_action_name', array($this->stub, 'handleRequest')));
    }
}
