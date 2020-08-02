<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\AlmostControllers;

use Korobochkin\WPKit\AlmostControllers\HttpStack;
use Korobochkin\WPKit\Tests\DataSets\AlmostControllers\TestAction;

class HttpStackTest extends \WP_UnitTestCase
{
    public function testRegister()
    {
        $stub = new HttpStack(array(), 'wp_kit_test_action_name');
        $this->setExpectedException(\LogicException::class, 'You need set actions before call register method.');
        $stub->register();
    }

    public function testRegisterWithActions()
    {
        $stub = new HttpStack(array(), 'wp_kit_test_action_name');

        $actions = array(
            new TestAction(),
        );

        $this->assertSame($stub, $stub->setActions($actions)->register());

        $this->assertSame(10, has_filter('admin_post_wp_kit_test_action_name', array($stub, 'handleRequest')));
        $this->assertSame(10, has_filter('admin_post_nopriv_wp_kit_test_action_name', array($stub, 'handleRequest')));
    }
}
