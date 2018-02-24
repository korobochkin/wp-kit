<?php
namespace Korobochkin\WPKit\Tests\Notices;

/**
 * Class NoticeInfoViewTest
 */
class NoticeInfoViewTest extends \WP_UnitTestCase
{
    public function testCssClasses()
    {
        $stub = new NoticeErrorView();
        $rp   = new \ReflectionProperty(NoticeErrorView::class, 'cssClasses');
        $rp->setAccessible(true);
        $this->assertEquals(array('notice', 'notice-info'), $rp->getValue($stub));
    }
}
