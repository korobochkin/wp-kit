<?php
namespace Korobochkin\WPKit\Tests\Notices;

use Korobochkin\WPKit\Notices\NoticeWarningView;

/**
 * Class NoticeWarningViewTest
 */
class NoticeWarningViewTest extends \WP_UnitTestCase
{
    public function testCssClasses()
    {
        $stub = new NoticeWarningView();
        $rp   = new \ReflectionProperty(NoticeWarningView::class, 'cssClasses');
        $rp->setAccessible(true);
        $this->assertSame(
            array(
                'notice',
                'notice-warning',
                'wp-kit-notice',
                'wp-kit-notice-warning'
            ),
            $rp->getValue($stub)
        );
    }
}
