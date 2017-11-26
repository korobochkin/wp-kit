<?php
namespace Korobochkin\WPKit\Tests\AlmostControllers;

use Korobochkin\WPKit\AlmostControllers\AbstractAction;
use Korobochkin\WPKit\AlmostControllers\Stack;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;

class AbstractActionTest extends \WP_UnitTestCase
{
    /**
     * @var AbstractAction
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForAbstractClass(AbstractAction::class);
    }

    public function testGetterAndSetterEnabledForLoggedIn()
    {
        $this->assertNull($this->stub->isEnabledForLoggedIn());

        $value = true;

        $this->assertEquals($this->stub, $this->stub->setEnabledForLoggedIn($value));
        $this->assertEquals($value, $this->stub->isEnabledForLoggedIn());
    }

    public function testGetterAndSetterEnabledForNotLoggedIn()
    {
        $this->assertNull($this->stub->isEnabledForNotLoggedIn());

        $value = true;

        $this->assertEquals($this->stub, $this->stub->setEnabledForNotLoggedIn($value));
        $this->assertEquals($value, $this->stub->isEnabledForNotLoggedIn());
    }

    public function testGetterAndSetterName()
    {
        $this->assertNull($this->stub->getName());

        $value = 'wp-kit-test-name';

        $this->assertEquals($this->stub, $this->stub->setName($value));
        $this->assertEquals($value, $this->stub->getName());
    }

    public function testGetterAndSetterStack()
    {
        $this->assertNull($this->stub->getStack());

        $value = new Stack(array(), 'test');

        $this->assertEquals($this->stub, $this->stub->setStack($value));
        $this->assertEquals($value, $this->stub->getStack());
    }

    public function testGetterAndSetterViolationsList()
    {
        $this->assertNull($this->stub->getViolationsList());

        $value = new ConstraintViolationList();

        $this->assertEquals($this->stub, $this->stub->setViolationsList($value));
        $this->assertEquals($value, $this->stub->getViolationsList());
    }

    public function testGetterAndSetterRequest()
    {
        $this->assertNull($this->stub->getRequest());

        $value = new Request();

        $this->assertEquals($this->stub, $this->stub->setRequest($value));
        $this->assertEquals($value, $this->stub->getRequest());
    }

    public function testGetterAndSetterResponse()
    {
        $this->assertNull($this->stub->getResponse());

        $value = new Response();

        $this->assertEquals($this->stub, $this->stub->setResponse($value));
        $this->assertEquals($value, $this->stub->getResponse());
    }

    public function testSetContainer()
    {
        $this->assertEquals($this->stub, $this->stub->setContainer(new ContainerBuilder()));
    }

    public function get()
    {
        $container = new ContainerBuilder();
        $container->register(Stack::class)
                  ->addArgument(array())
                  ->addArgument('test');

        $this->stub->setContainer($container);
        $this->assertTrue(is_a($this->stub->get(Stack::class), Stack::class));
    }
}
