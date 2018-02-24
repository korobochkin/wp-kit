<?php
namespace Korobochkin\WPKit\Tests\Notices;

use Korobochkin\WPKit\Notices\NoticeErrorView;

/**
 * Class NoticeErrorViewTest
 */
class NoticeErrorViewTest extends \WP_UnitTestCase
{
    public function testCssClasses()
    {
        $stub = new NoticeErrorView();
        $rp   = new \ReflectionProperty(NoticeErrorView::class, 'cssClasses');
        $rp->setAccessible(true);
        $this->assertEquals(array('notice', 'notice-error', 'wp-kit-notice', 'wp-kit-notice-error'), $rp->getValue($stub));
    }
}
