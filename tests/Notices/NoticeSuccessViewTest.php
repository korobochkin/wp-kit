<?php
namespace Korobochkin\WPKit\Tests\Notices;

use Korobochkin\WPKit\Notices\NoticeSuccessView;

/**
 * Class NoticeSuccessViewTest
 */
class NoticeSuccessViewTest extends \WP_UnitTestCase
{
    public function testCssClasses()
    {
        $stub = new NoticeSuccessView();
        $rp   = new \ReflectionProperty(NoticeSuccessView::class, 'cssClasses');
        $rp->setAccessible(true);
        $this->assertSame(
            array(
                'notice',
                'notice-success',
                'wp-kit-notice',
                'wp-kit-notice-success'
            ),
            $rp->getValue($stub)
        );
    }
}
