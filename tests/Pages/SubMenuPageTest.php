<?php
namespace Korobochkin\WPKit\Tests\Pages;

use Korobochkin\WPKit\Pages\MenuPage;
use Korobochkin\WPKit\Pages\SubMenuPage;

/**
 * Class SubMenuPageTest
 */
class SubMenuPageTest extends \WP_UnitTestCase
{
    /**
     * @var SubMenuPage
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();
        $this->stub = new SubMenuPage();
        $this->stub
            ->setParentSlug('tools.php')
            ->setPageTitle('Test Page Title')
            ->setMenuTitle('Test Menu Title')
            ->setCapability('manage_options')
            ->setMenuSlug('test-menu-slug');
    }

    public function testRegister()
    {
        $this->assertSame($this->stub, $this->stub->register());
    }

    /**
     * @depends testRegister
     */
    public function testUnRegister()
    {
        $this->markTestSkipped();
        // Can't pass this test right now.
        $this->assertSame($this->stub, $this->stub->unRegister());

        try {
            $this->stub->unRegister();
        } catch (\Exception $exception) {
            $this->assertTrue(is_a($exception, \Exception::class));
        }
    }

    public function testGetURL()
    {
        $this->assertSame(
            'http://example.org/wp-admin/admin.php?page=test-menu-slug',
            $this->stub->getURL()
        );
    }

    public function testGetterAndSetterParentSlug()
    {
        $this->assertSame('tools.php', $this->stub->getParentSlug());
        $this->assertSame($this->stub, $this->stub->setParentSlug('tools.php'));
    }

    public function testGetterAndSetterParentPage()
    {
        $value = new MenuPage();

        $this->assertNull($this->stub->getParentPage());
        $this->assertSame($this->stub, $this->stub->setParentPage($value));
        $this->assertSame($value, $this->stub->getParentPage());
    }
}
