<?php
namespace Korobochkin\WPKit\Tests\Pages;

use Korobochkin\WPKit\Pages\MenuPage;

/**
 * Class MenuPageTest
 */
class MenuPageTest extends \WP_UnitTestCase
{
    /**
     * @var MenuPage
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();
        $this->stub = new MenuPage();
        $this->stub
            ->setPageTitle('Test Page Title')
            ->setMenuTitle('Test Menu Title')
            ->setCapability('test_capability')
            ->setMenuSlug('test-menu-slug')
            ->setIcon('dashicons-admin-site')
            ->setPosition(100);
    }

    public function testRegister()
    {
        $this->assertEquals($this->stub, $this->stub->register());
    }

    /**
     * @depends testRegister
     */
    public function testUnRegister()
    {
        $this->assertEquals($this->stub, $this->stub->unRegister());

        try {
            $this->stub->unRegister();
        } catch (\Exception $exception) {
            $this->assertTrue(is_a($exception,\Exception::class));
        }
    }

    public function testGetURL()
    {
        $this->assertEquals(
            'http://example.com/wp-admin/options-general.php?page=test-menu-slug',
            $this->stub->getURL()
        );
    }

    public function testGetterAndSetterIcon()
    {
        $this->assertEquals('dashicons-admin-site', $this->stub->getIcon());
        $this->assertEquals($this->stub, $this->stub->setIcon('dashicons-admin-site'));
    }

    public function testGetterAndSetterPosition()
    {
        $this->assertEquals(100, $this->stub->getPosition());
        $this->assertEquals($this->stub, $this->stub->setPosition(100));
    }
}
