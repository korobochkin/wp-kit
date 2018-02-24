<?php
namespace Korobochkin\WPKit\Tests\Notices;

use Korobochkin\WPKit\Notices\NoticeInfoView;

/**
 * Class NoticeInfoViewTest
 */
class NoticeInfoViewTest extends \WP_UnitTestCase
{
    public function testCssClasses()
    {
        $stub = new NoticeInfoView();
        $rp   = new \ReflectionProperty(NoticeInfoView::class, 'cssClasses');
        $rp->setAccessible(true);
        $this->assertEquals(
            array(
                'notice',
                'notice-info',
                'wp-kit-notice',
                'wp-kit-notice-info'
            ),
            $rp->getValue($stub)
        );
    }
}
