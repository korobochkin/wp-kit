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
        $this->assertTrue($this->stub->isEnabledForLoggedIn());

        $value = true;

        $this->assertSame($this->stub, $this->stub->setEnabledForLoggedIn($value));
        $this->assertSame($value, $this->stub->isEnabledForLoggedIn());
    }

    public function testGetterAndSetterEnabledForNotLoggedIn()
    {
        $this->assertFalse($this->stub->isEnabledForNotLoggedIn());

        $value = true;

        $this->assertSame($this->stub, $this->stub->setEnabledForNotLoggedIn($value));
        $this->assertSame($value, $this->stub->isEnabledForNotLoggedIn());
    }

    public function testGetterAndSetterName()
    {
        $this->assertNull($this->stub->getName());

        $value = 'wp-kit-test-name';

        $this->assertSame($this->stub, $this->stub->setName($value));
        $this->assertSame($value, $this->stub->getName());
    }

    public function testGetterAndSetterStack()
    {
        $this->assertNull($this->stub->getStack());

        $value = new Stack(array(), 'test');

        $this->assertSame($this->stub, $this->stub->setStack($value));
        $this->assertSame($value, $this->stub->getStack());
    }

    public function testGetterAndSetterViolationsList()
    {
        $this->assertNull($this->stub->getViolationsList());

        $value = new ConstraintViolationList();

        $this->assertSame($this->stub, $this->stub->setViolationsList($value));
        $this->assertSame($value, $this->stub->getViolationsList());
    }

    public function testGetterAndSetterRequest()
    {
        $this->assertNull($this->stub->getRequest());

        $value = new Request();

        $this->assertSame($this->stub, $this->stub->setRequest($value));
        $this->assertSame($value, $this->stub->getRequest());
    }

    public function testGetterAndSetterResponse()
    {
        $this->assertNull($this->stub->getResponse());

        $value = new Response();

        $this->assertSame($this->stub, $this->stub->setResponse($value));
        $this->assertSame($value, $this->stub->getResponse());
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
