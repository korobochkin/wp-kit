<?php
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
        $this->assertEquals($this->stub, $this->stub->setVirtualPage($value));
        $this->assertEquals($value, $this->stub->getVirtualPage());
    }
}
