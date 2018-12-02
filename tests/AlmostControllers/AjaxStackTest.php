<?php
namespace Korobochkin\WPKit\Tests\AlmostControllers;

use Korobochkin\WPKit\AlmostControllers\AjaxStack;
use Korobochkin\WPKit\Tests\DataSets\AlmostControllers\TestAction;

class AjaxStackTest extends \WP_UnitTestCase
{
    public function testRegister()
    {
        $stub = new AjaxStack(array(), 'wp_kit_test_action_name');
        $this->setExpectedException(\LogicException::class, 'You need set actions before call register method.');
        $stub->register();
    }

    public function testRegisterWithActions()
    {
        $stub = new AjaxStack(array(), 'wp_kit_test_action_name');

        $actions = array(
            new TestAction(),
        );

        $stub
            ->setActions($actions)
            ->register();

        $this->assertSame(10, has_filter('wp_ajax_wp_kit_test_action_name', array($stub, 'handleRequest')));
        $this->assertSame(10, has_filter('wp_ajax_nopriv_wp_kit_test_action_name', array($stub, 'handleRequest')));
    }
}
