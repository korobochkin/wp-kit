<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Pages;

use Korobochkin\WPKit\Pages\MenuPage;
use Korobochkin\WPKit\Pages\VirtualMenuPage;

/**
 * Class VirtualMenuPageTest
 */
class VirtualMenuPageTest extends \WP_UnitTestCase
{
    /**
     * @var VirtualMenuPage
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();
        $this->stub = new VirtualMenuPage();
    }

    public function testGetterAndSetterVirtualPage()
    {
        $value = new MenuPage();
        $this->assertNull($this->stub->getVirtualPage());
        $this->assertSame($this->stub, $this->stub->setVirtualPage($value));
        $this->assertSame($value, $this->stub->getVirtualPage());
    }

    public function testRender()
    {
        $title = 'WP Kit Test Virtual Title';

        $page = new MenuPage();
        $page->setView(new PageTestingPurposesView())
             ->setPageTitle($title);
        $this->stub->setVirtualPage($page);

        ob_start();
        $this->stub->render();
        $this->assertSame(
            '<div class="wp-kit-test-page-wrapper"><h1>' . $title . '</h1><p>Page text.</p></div>',
            ob_get_contents()
        );
        ob_end_clean();
    }

    public function testLateConstruct()
    {
        $this->stub->setVirtualPage(new MenuPage());
        $this->assertSame($this->stub, $this->stub->lateConstruct());
    }
}
