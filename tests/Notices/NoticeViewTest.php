<?php
declare(strict_types=1);

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
        $expected = '<div id="wp-kit-notice-my_plugin_test_name" class="notice wp-kit-notice is-dismissible wp-kit-notice-my_plugin_test_name"><p class="notice-title">Test title</p><p>Test content</p></div>';
        //@codingStandardsIgnoreEnd

        $this->assertSame($expected, $content);
    }

    public function testCssClasses()
    {
        $stub = new NoticeView();
        $rp   = new \ReflectionProperty(NoticeView::class, 'cssClasses');
        $rp->setAccessible(true);
        $this->assertSame(
            array(
                'notice',
                'wp-kit-notice',
            ),
            $rp->getValue($stub)
        );
    }

    public function testGetterAndSetter()
    {
        $stub = new NoticeView();

        $this->assertSame(
            array(
                'notice',
                'wp-kit-notice',
            ),
            $stub->getCssClasses()
        );

        $this->assertSame($stub, $stub->setCssClasses(array('test', 'test-2')));

        $this->assertSame(array('test', 'test-2'), $stub->getCssClasses());
    }
}
