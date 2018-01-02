<?php
namespace Korobochkin\WPKit\Tests\MetaBoxes;

use Korobochkin\WPKit\MetaBoxes\AbstractDashboardMetaBox;

/**
 * Class AbstractDashboardMetaBoxTest
 */
class AbstractDashboardMetaBoxTest extends \WP_UnitTestCase
{
    const META_BOX_ID = 'wp_kit_test_dashboard_meta_box_id';

    const META_BOX_TITLE = 'WP Kit Dashboard Meta Box Test Title';

    /**
     * @var AbstractDashboardMetaBox
     */
    protected $stub;

    /**
     * Prepare stub for tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForAbstractClass(AbstractDashboardMetaBox::class);
    }

    public function testRegister()
    {
        $this->stub
            ->setId(self::META_BOX_ID)
            ->setTitle(self::META_BOX_TITLE);

        $this->assertEquals($this->stub, $this->stub->register());

        $this->assertTrue(has_action('load-index.php', array($this->stub, 'lateConstruct')));
    }
}
