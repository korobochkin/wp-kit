<?php
namespace Korobochkin\WPKit\Tests\Pages\Views;

use Korobochkin\WPKit\Pages\MenuPage;
use Korobochkin\WPKit\Pages\PageInterface;
use Korobochkin\WPKit\Pages\Views\TwigPageView;

class TwigPageViewTest extends \WP_UnitTestCase
{
    /**
     * @var TwigPageView
     */
    protected $stub;

    /**
     * @var PageInterface
     */
    protected $page;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    function setUp()
    {
        parent::setUp();

        /**
         * @var $stub TwigPageView
         */
        $this->stub = new TwigPageView();
        $this->page = new MenuPage();

        $this->twig = new \Twig_Environment(
            new \Twig_Loader_Array(array(
                'title' => '{{ "my first car"|title }}',
                'min'   => '{{ min(1, 3, 2) }}',
            ))
        );
    }

    public function testRender()
    {
        $this->stub
            ->setTwigEnvironment($this->twig)
            ->setTemplate('title');

        ob_start();
        $this->stub->render($this->page);
        $this->assertSame('My First Car', ob_get_contents());
        ob_end_clean();

        $this->stub->setTemplate('min');
        ob_start();
        $this->stub->render($this->page);
        $this->assertSame('1', ob_get_contents());
        ob_end_clean();
    }

    public function testGetterAndSetterTemplate()
    {
        $value = 'wp-kit-template.html.twig';
        $this->assertNull($this->stub->getTemplate());
        $this->assertSame($this->stub, $this->stub->setTemplate($value));
        $this->assertSame($value, $this->stub->getTemplate());
    }

    public function testGetterAndSetterContext()
    {
        $value = array(
            'param1' => 'value1',
            'param2' => 'value2',
        );
        $this->assertNull($this->stub->getContext());
        $this->assertSame($this->stub, $this->stub->setContext($value));
        $this->assertSame($value, $this->stub->getContext());
    }

    public function testGetterAndSetterTwigEnvironment()
    {
        $this->assertNull($this->stub->getTwigEnvironment());
        $this->assertSame($this->stub, $this->stub->setTwigEnvironment($this->twig));
        $this->assertSame($this->twig, $this->stub->getTwigEnvironment());
    }
}
