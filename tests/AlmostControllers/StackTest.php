<?php
namespace Korobochkin\WPKit\Tests\AlmostControllers;

use Korobochkin\WPKit\AlmostControllers\Exceptions\ActionNotFoundException;
use Korobochkin\WPKit\AlmostControllers\Stack;
use Korobochkin\WPKit\Tests\DataSets\AlmostControllers\TestAction;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class StackTest
 */
class StackTest extends \WP_UnitTestCase
{
    /**
     * @var Stack
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();

        $this->stub = new Stack(array(), 'wp_kit_test_action_name');
    }

    public function testGetterAndSetterActions()
    {
        $this->assertEquals(array(), $this->stub->getActions());
        $this->assertEquals($this->stub, $this->stub->setActions(array()));
    }

    public function testGetterAndSetterActionName()
    {
        $this->assertEquals('wp_kit_test_action_name', $this->stub->getActionName());
        $this->assertEquals($this->stub, $this->stub->setActionName('wp_kit_test_action_name'));
    }

    public function testGetterAndSetterRequest()
    {
        $this->assertEquals(null, $this->stub->getRequest());

        $value = new Request();

        $this->assertEquals($this->stub, $this->stub->setRequest($value));
        $this->assertEquals($value, $this->stub->getRequest());
    }

    public function testGetterAndSetterResponse()
    {
        $this->assertEquals(null, $this->stub->getResponse());

        $value = new Response();

        $this->assertEquals($this->stub, $this->stub->setResponse($value));
        $this->assertEquals($value, $this->stub->getResponse());
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
    }

    public function testHandleRequest()
    {
        $actions = array(
            new TestAction(),
        );

        $request = new Request(array(
            'actionName' => TestAction::class,
        ));

        $response = new JsonResponse();

        $this->stub
            ->setActions($actions)
            ->setRequest($request)
            ->setResponse($response)
            ->handleRequest();

        $request = new Request(array(
            'actionName' => 'uknown-action-name',
        ));

        $this->setExpectedException(ActionNotFoundException::class);

        $this->stub
            ->setActions($actions)
            ->setRequest($request)
            ->setResponse($response)
            ->handleRequest();
    }

    public function testSetContainer()
    {
        $this->assertEquals($this->stub, $this->stub->setContainer(new ContainerBuilder()));
    }

    public function get()
    {
        $container = new ContainerBuilder();
        $container->register(StackTest::class)
            ->addArgument(array())
            ->addArgument('test');

        $this->stub->setContainer($container);
        $this->assertTrue(is_a($this->stub->get(StackTest::class), StackTest::class));
    }
}
