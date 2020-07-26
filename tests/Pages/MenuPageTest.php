<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Pages;

use Korobochkin\WPKit\Pages\MenuPage;
use Korobochkin\WPKit\Utils\Compatibility;

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
        $this->assertSame($this->stub, $this->stub->register());
    }

    /**
     * @depends testRegister
     */
    public function testUnRegister()
    {
        $this->assertSame($this->stub, $this->stub->unRegister());

        try {
            $this->stub->unRegister();
        } catch (\Exception $exception) {
            $this->assertTrue(is_a($exception, \Exception::class));
        }
    }

    public function testGetURL()
    {
        if (!Compatibility::checkWordPress('5.3') && PHP_VERSION_ID >= 70400) {
            $this->markTestSkipped('https://core.trac.wordpress.org/ticket/47783');
        }

        $this->assertSame(
            'http://example.org/wp-admin/options-general.php?page=test-menu-slug',
            $this->stub->getURL()
        );
    }

    public function testGetterAndSetterIcon()
    {
        $this->assertSame('dashicons-admin-site', $this->stub->getIcon());
        $this->assertSame($this->stub, $this->stub->setIcon('dashicons-admin-site'));
    }

    public function testGetterAndSetterPosition()
    {
        $this->assertSame(100, $this->stub->getPosition());
        $this->assertSame($this->stub, $this->stub->setPosition(100));
    }
}
