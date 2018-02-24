<?php
namespace Korobochkin\WPKit\Tests\Notices;

use Korobochkin\WPKit\Notices\Notice;
use Korobochkin\WPKit\Notices\NoticesStack;
use Korobochkin\WPKit\Notices\NoticeView;

/**
 * Class NoticeViewTest
 */
class NoticeViewTest extends \WP_UnitTestCase
{
    public function testRender()
    {
        $stub   = new NoticesStack();
        $notice = new Notice();
        $notice
            ->setName('my_plugin_test_name')
            ->setTitle('Test title')
            ->setContent('<p>Test content</p>')
            ->setView(new NoticeView())
            ->setDismissible(true);
        $stub->addNotice($notice);

        ob_start();
        $stub->run();
        $content = ob_get_contents();
        ob_end_clean();

        //@codingStandardsIgnoreStart
        $expected = '<div class="notice wp-kit-notice wp-kit-notice-my_plugin_test_name"><p class="notice-title">Test title</p><p>Test content</p></div>';
        //@codingStandardsIgnoreEnd

        $this->assertEquals($expected, $content);
    }

    public function testCssClasses()
    {
        $stub = new NoticeView();
        $rp   = new \ReflectionProperty(NoticeView::class, 'cssClasses');
        $rp->setAccessible(true);
        $this->assertEquals(
            array(
                'notice',
                'wp-kit-notice',
            ),
            $rp->getValue($stub)
        );
    }
}
