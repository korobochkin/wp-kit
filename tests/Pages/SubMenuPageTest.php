<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Pages;

use Korobochkin\WPKit\Pages\MenuPage;
use Korobochkin\WPKit\Pages\SubMenuPage;
use Korobochkin\WPKit\Utils\Compatibility;
use Korobochkin\WPKit\Utils\WordPressFeatures;

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
        global $wp_version;
        if ('4.0' === $wp_version && PHP_VERSION_ID >= 70000) {
            $this->markTestSkipped('wp_insert_user() call triggers error in old WP and new PHP.');
        }

        $id = wp_insert_user(array(
            'user_login' => 'wp_kit_user',
            'user_email' => 'wp_kit_user@example.org',
            'user_pass' => '123456',
            'role' => 'administrator',
        ));
        wp_set_current_user($id);
        $this->assertSame($this->stub, $this->stub->register());

        $page = get_plugin_page_hookname($this->stub->getMenuSlug(), $this->stub->getParentSlug());

        $this->assertSame(10, has_action('load-'.$page, array($this->stub, 'lateConstruct')));
        $this->assertSame(10, has_action('admin_action_update', array($this->stub, 'lateConstruct')));
        $this->stub->unRegister();
    }

    public function testUnRegister()
    {
        $this->setExpectedException(\Exception::class);
        $this->stub->unRegister();
    }

    /*public function testUnRegisterRegisteredPage()
    {
        $id = wp_insert_user(array(
            'user_login' => 'wp_kit_user',
            'user_email' => 'wp_kit_user@example.org',
            'user_pass' => '123456',
            'role' => 'administrator',
        ));
        wp_set_current_user($id);
        $this->stub->register();

        $this->assertSame($this->stub, $this->stub->unRegister());
    }*/

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
