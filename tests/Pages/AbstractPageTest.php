<?php
namespace Korobochkin\WPKit\Tests\Pages;

use Korobochkin\WPKit\Pages\AbstractPage;
use Korobochkin\WPKit\Pages\Views\TwigPageView;
use Symfony\Component\Form\FormFactoryBuilder;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AbstractPageTest
 */
class AbstractPageTest extends \WP_UnitTestCase
{
    /**
     * @var AbstractPage
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForAbstractClass(AbstractPage::class);
    }

    public function testLateConstruct()
    {
        $this->assertEquals($this->stub, $this->stub->lateConstruct());
    }

    public function testGetterAndSetterName()
    {
        $value = 'test-name';

        $this->assertNull($this->stub->getName());
        $this->assertEquals($this, $this->stub->setName($value));
        $this->assertEquals($value, $this->stub->getName());
    }

    public function testGetterAndSetterPageTitle()
    {
        $value = 'Test Page Title';

        $this->assertNull($this->stub->getPageTitle());
        $this->assertEquals($this, $this->stub->setPageTitle($value));
        $this->assertEquals($value, $this->stub->getPageTitle());
    }

    public function testGetterAndSetterMenuTitle()
    {
        $value = 'Test Menu Title';

        $this->assertNull($this->stub->getMenuTitle());
        $this->assertEquals($this, $this->stub->setMenuTitle($value));
        $this->assertEquals($value, $this->stub->getMenuTitle());
    }

    public function testGetterAndSetterCapability()
    {
        $value = 'test_manage_options';

        $this->assertNull($this->stub->getCapability());
        $this->assertEquals($this, $this->stub->setCapability($value));
        $this->assertEquals($value, $this->stub->getCapability());
    }

    public function testGetterAndSetterMenuSlug()
    {
        $value = 'test-menu-slug';

        $this->assertNull($this->stub->getMenuSlug());
        $this->assertEquals($this, $this->stub->setMenuSlug($value));
        $this->assertEquals($value, $this->stub->getMenuSlug());
    }

    public function testGetterAndSetterView()
    {
        $value = new TwigPageView();

        $this->assertNull($this->stub->getView());
        $this->assertEquals($this, $this->stub->setView($value));
        $this->assertEquals($value, $this->stub->getView());
    }

    /*public function testGetterAndSetterRequest()
    {
        $value = new Request();

        $this->assertNull($this->stub->getRequest());
        $this->assertEquals($this, $this->stub->setRequest($value));
        $this->assertEquals($value, $this->stub->getRequest());
    }

    public function testGetterAndSetterFormFactory()
    {
        $value = new FormFactoryBuilder();
        $value = $value->getFormFactory();

        $this->assertNull($this->stub->getFormFactory());
        $this->assertEquals($this, $this->stub->setFormFactory($value));
        $this->assertEquals($value, $this->stub->getFormFactory());
    }

    public function testGetterAndSetterForm()
    {
        $this->assertNull($this->stub->getForm());
        //$this->assertEquals($this, $this->stub->setForm($value));
        //$this->assertEquals($value, $this->stub->getForm());
    }

    public function testGetterAndSetterFormEntity()
    {
        $value = new \stdClass();

        $this->assertNull($this->stub->getFormEntity());
        $this->assertEquals($this, $this->stub->setFormEntity($value));
        $this->assertEquals($value, $this->stub->getFormEntity());
    }

    public function testHandleRequest()
    {
        //$this->assertNull($this->stub->handleRequest());
    }*/
}
