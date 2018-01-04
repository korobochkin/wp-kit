<?php
namespace Korobochkin\WPKit\Tests\MetaBoxes;

use Korobochkin\WPKit\MetaBoxes\DashboardMetaBox;

/**
 * Class AbstractDashboardMetaBoxTest
 */
class DashboardMetaBoxTest extends \WP_UnitTestCase
{
    const META_BOX_ID = 'wp_kit_test_dashboard_meta_box_id';

    const META_BOX_TITLE = 'WP Kit Dashboard Meta Box Test Title';

    /**
     * @var DashboardMetaBox
     */
    protected $stub;

    /**
     * Prepare stub for tests.
     */
    public function setUp()
    {
        parent::setUp();
        require_once(ABSPATH . 'wp-admin/includes/dashboard.php');
        $this->stub = new DashboardMetaBox();
    }

    public function testRegister()
    {
        $this->stub
            ->setId(self::META_BOX_ID)
            ->setTitle(self::META_BOX_TITLE);

        global $current_screen;

        $current_screen = \WP_Screen::get('dashboard');

        $this->assertEquals($this->stub, $this->stub->register());

        $this->assertInternalType('int', has_action('load-index.php', array($this->stub, 'lateConstruct')));
    }
}
