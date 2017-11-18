<?php
namespace Korobochkin\WPKit\Tests\AlmostControllers;

use Korobochkin\WPKit\AlmostControllers\AjaxStack;
use Korobochkin\WPKit\Tests\DataSets\AlmostControllers\TestAction;

class AjaxStackTest extends \WP_UnitTestCase
{
    /**
     * @var AjaxStack
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();

        $this->stub = new AjaxStack(array(), 'wp_kit_test_action_name');
    }

    public function testRegister()
    {
        $this->setExpectedException(\LogicException::class);
        $this->stub->register();

        $this->setExpectedException(null);

        $actions = array(
            new TestAction(),
        );

        $this->stub
            ->setActions($actions)
            ->register();

        $this->assertTrue(has_filter('wp_ajax_wp_kit_test_action_name', array($this->stub, 'handleRequest')));
        $this->assertTrue(has_filter('wp_ajax_nopriv_wp_kit_test_action_name', array($this->stub, 'handleRequest')));
    }
}
