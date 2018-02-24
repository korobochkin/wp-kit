<?php
namespace Korobochkin\WPKit\Tests\Notices;

use Korobochkin\WPKit\Notices\Notice;
use Korobochkin\WPKit\Notices\NoticesStack;
use Korobochkin\WPKit\Notices\NoticeSuccessView;
use Korobochkin\WPKit\Tests\DataSets\Notices\SomeTestNotice;

/**
 * Class NoticesStackTest
 */
class NoticesStackTest extends \WP_UnitTestCase
{
    public function testGetterAndSetterNotices()
    {
        $stub = new NoticesStack();

        $this->assertEquals(array(), $stub->getNotices());

        $value = array(
            new Notice(),
            new Notice(),
        );

        $this->assertEquals($stub, $stub->setNotices($value));
        $this->assertEquals($value, $stub->getNotices());
    }

    public function testAddNotice()
    {
        $stub   = new NoticesStack();
        $notice = new Notice();

        $this->assertEquals($stub, $stub->addNotice($notice));
        $this->assertEquals(array($notice), $stub->getNotices());
    }

    public function testRemoveNoticeByName()
    {
        $stub   = new NoticesStack();
        $notice = new Notice();
        $notice->setName('wp_kit_test_notice');
        $stub->addNotice($notice);

        $this->assertNotEmpty($stub->getNotices());

        $stub->removeNoticeByName('wp_kit_test_notice');

        $this->assertEmpty($stub->getNotices());
    }

    public function testRemoveNoticeByClassName()
    {
        $stub   = new NoticesStack();
        $notice = new SomeTestNotice();
        $stub->addNotice($notice);

        $this->assertNotEmpty($stub->getNotices());

        $stub->removeNoticeByClassName(SomeTestNotice::class);

        $this->assertEmpty($stub->getNotices());
    }

    public function testRun()
    {
        $stub   = new NoticesStack();
        $notice = new Notice();
        $notice
            ->setName('my_plugin_test_name')
            ->setTitle('Test title')
            ->setContent('<p>Test content</p>')
            ->setView(new NoticeSuccessView());
        $stub->addNotice($notice);

        ob_start();
        $stub->run();
        $content = ob_get_contents();
        ob_end_clean();

        //@codingStandardsIgnoreStart
        $expected = '<div class="notice notice-success wp-kit-notice wp-kit-notice-success wp-kit-notice-my_plugin_test_name"><p class="notice-title">Test title</p><p>Test content</p></div>';
        //@codingStandardsIgnoreEnd

        $this->assertEquals($expected, $content);
    }
}
