<?php
namespace Korobochkin\WPKit\Tests\AlmostControllers;

use Korobochkin\WPKit\AlmostControllers\AbstractAction;
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
        $this->assertSame(array(), $this->stub->getActions());
        $this->assertSame($this->stub, $this->stub->setActions(array()));
    }

    public function testAddAction()
    {
        /**
         * @var $action AbstractAction
         */
        $this->assertSame(array(), $this->stub->getActions());
        $action = $this->getMockForAbstractClass(AbstractAction::class);
        $action->setName('wp_kit_test_action');
        $expected = array(
            'wp_kit_test_action' => $action,
        );

        $this->assertSame($this->stub, $this->stub->addAction($action));
        $this->assertSame($expected, $this->stub->getActions());
    }

    public function testGetterAndSetterActionName()
    {
        $this->assertSame('wp_kit_test_action_name', $this->stub->getActionName());
        $this->assertSame($this->stub, $this->stub->setActionName('wp_kit_test_action_name'));
    }

    public function testGetterAndSetterRequest()
    {
        $this->assertSame(null, $this->stub->getRequest());

        $value = new Request();

        $this->assertSame($this->stub, $this->stub->setRequest($value));
        $this->assertSame($value, $this->stub->getRequest());
    }

    public function testGetterAndSetterResponse()
    {
        $this->assertSame(null, $this->stub->getResponse());

        $value = new Response();

        $this->assertSame($this->stub, $this->stub->setResponse($value));
        $this->assertSame($value, $this->stub->getResponse());
    }

    public function testRegister()
    {
        $this->setExpectedException(\LogicException::class, 'You need set actions before call register method.');
        $this->stub->register();
    }

    public function testRegisterWithActions()
    {
        $actions = array(
            new TestAction(),
        );

        $this->assertSame($this->stub, $this->stub->setActions($actions)->register());
    }

    public function testRequestManagerWithoutActionName()
    {
        $actions = array(
            TestAction::class => new TestAction(),
        );

        $request  = new Request();
        $response = new JsonResponse();

        $this->stub
            ->setActions($actions)
            ->setRequest($request)
            ->setResponse($response);

        $this->setExpectedException(ActionNotFoundException::class);

        $this->stub->requestManager();
    }

    public function testRequestManagerActionBuilding()
    {
        $actions = array(
            TestAction::class => TestAction::class,
        );

        $request  = new Request();
        $response = new JsonResponse();

        $this->stub
            ->setActions($actions)
            ->setRequest(clone $request)
            ->setResponse(clone $response);

        $this->assertSame($this->stub, $this->stub->requestManager());
        $actions = $this->stub->getActions();
        $this->assertInstanceOf(TestAction::class, $actions[TestAction::class]);
        $this->assertInternalType('object', $actions[TestAction::class]);
        $this->assertEquals($response, $this->stub->getResponse());
        $this->assertEquals($request, $this->stub->getRequest());
    }

    public function testRequestManager()
    {
        $actions = array(
            TestAction::class => new TestAction(),
        );

        $request = new Request(array(
            'actionName' => TestAction::class,
        ));

        $response = new JsonResponse();

        $this->stub
            ->setActions($actions)
            ->setRequest($request)
            ->setResponse($response)
            ->requestManager();

        $request = new Request(array(
            'actionName' => 'uknown-action-name',
        ));

        $this->setExpectedException(ActionNotFoundException::class);

        $this->stub
            ->setActions($actions)
            ->setRequest($request)
            ->setResponse($response)
            ->requestManager();
    }

    public function testSetContainer()
    {
        $this->assertSame($this->stub, $this->stub->setContainer(new ContainerBuilder()));
    }

    public function testGet()
    {
        $container = new ContainerBuilder();
        $container->register('wp_kit_test_service', \stdClass::class);
        $expected = $container->get('wp_kit_test_service');

        $this->stub->setContainer($container);
        $this->assertInstanceOf(\stdClass::class, $this->stub->get('wp_kit_test_service'));
        $this->assertSame($expected, $this->stub->get('wp_kit_test_service'));
    }
}
