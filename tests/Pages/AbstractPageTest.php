<?php
namespace Korobochkin\WPKit\Tests\Pages;

use Korobochkin\WPKit\Pages\AbstractPage;
use Korobochkin\WPKit\Pages\Tabs\Tabs;
use Korobochkin\WPKit\Pages\Views\TwigPageView;
use Symfony\Component\Form\FormFactoryBuilder;
use Symfony\Component\Form\Forms;
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
        $this->assertSame($this->stub, $this->stub->lateConstruct());
    }

    public function testGetterAndSetterName()
    {
        $value = 'test-name';

        $this->assertNull($this->stub->getName());
        $this->assertSame($this->stub, $this->stub->setName($value));
        $this->assertSame($value, $this->stub->getName());
    }

    public function testGetterAndSetterPageTitle()
    {
        $value = 'Test Page Title';

        $this->assertNull($this->stub->getPageTitle());
        $this->assertSame($this->stub, $this->stub->setPageTitle($value));
        $this->assertSame($value, $this->stub->getPageTitle());
    }

    public function testGetterAndSetterMenuTitle()
    {
        $value = 'Test Menu Title';

        $this->assertNull($this->stub->getMenuTitle());
        $this->assertSame($this->stub, $this->stub->setMenuTitle($value));
        $this->assertSame($value, $this->stub->getMenuTitle());
    }

    public function testGetterAndSetterCapability()
    {
        $value = 'test_manage_options';

        $this->assertNull($this->stub->getCapability());
        $this->assertSame($this->stub, $this->stub->setCapability($value));
        $this->assertSame($value, $this->stub->getCapability());
    }

    public function testGetterAndSetterMenuSlug()
    {
        $value = 'test-menu-slug';

        $this->assertNull($this->stub->getMenuSlug());
        $this->assertSame($this->stub, $this->stub->setMenuSlug($value));
        $this->assertSame($value, $this->stub->getMenuSlug());
    }

    public function testGetterAndSetterView()
    {
        $value = new TwigPageView();

        $this->assertNull($this->stub->getView());
        $this->assertSame($this->stub, $this->stub->setView($value));
        $this->assertSame($value, $this->stub->getView());
    }

    public function testRender()
    {
        $title = 'WP Kit Test Title';
        $this->stub
            ->setView(new PageTestingPurposesView())
            ->setPageTitle($title);

        ob_start();
        $this->stub->render();
        $this->assertSame(
            '<div class="wp-kit-test-page-wrapper"><h1>' . $title . '</h1><p>Page text.</p></div>',
            ob_get_contents()
        );
        ob_end_clean();
    }

    public function testEnqueueScriptStyles()
    {
        $this->assertNull($this->stub->enqueueScriptStyles());
    }

    public function testGetterAndSetterRequest()
    {
        $value = new Request();

        $this->assertNull($this->stub->getRequest());
        $this->assertSame($this->stub, $this->stub->setRequest($value));
        $this->assertSame($value, $this->stub->getRequest());
    }

    public function testGetterAndSetterFormFactory()
    {
        $value = new FormFactoryBuilder();
        $value = $value->getFormFactory();

        $this->assertNull($this->stub->getFormFactory());
        $this->assertSame($this->stub, $this->stub->setFormFactory($value));
        $this->assertSame($value, $this->stub->getFormFactory());
    }

    public function testGetterAndSetterForm()
    {
        $value = Forms::createFormFactoryBuilder()->getFormFactory()->create();
        $this->assertNull($this->stub->getForm());
        $this->assertSame($this->stub, $this->stub->setForm($value));
        $this->assertSame($value, $this->stub->getForm());
    }

    public function testGetterAndSetterFormEntity()
    {
        $value = new \stdClass();

        $this->assertNull($this->stub->getFormEntity());
        $this->assertSame($this->stub, $this->stub->setFormEntity($value));
        $this->assertSame($value, $this->stub->getFormEntity());
    }

    public function testGetterAndSetterTabs()
    {
        $value = new Tabs();
        $this->assertNull($this->stub->getTabs());
        $this->assertSame($this->stub, $this->stub->setFormEntity($value));
        $this->assertSame($value, $this->stub->getFormEntity());
    }

    public function testHandleRequest()
    {
        $this->assertNull($this->stub->handleRequest());
    }
}
