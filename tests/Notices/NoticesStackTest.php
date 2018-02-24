<?php
namespace Korobochkin\WPKit\Tests\Notices;

use Korobochkin\WPKit\Notices\Notice;
use Korobochkin\WPKit\Notices\NoticesStack;
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
}
