<?php
namespace Korobochkin\WPKit\Tests\Notices;

use Korobochkin\WPKit\Notices\Notice;

/**
 * Class NoticeTest
 */
class NoticeTest extends \WP_UnitTestCase
{
    public function testLateConstruct()
    {
        $stub = new Notice();
        $this->assertEquals($stub, $stub->lateConstruct());
        $this->assertInstanceOf(Notice::class, $stub->lateConstruct());
    }

    public function testGetterAndSetterName()
    {
        /**
         * @var $stub Notice
         */
        $stub = new Notice();

        $this->assertEquals(null, $stub->getName());

        $value = 'wp_kit_test_notice_name';

        $this->assertEquals($stub, $stub->setName($value));
        $this->assertEquals($value, $stub->getName());
    }

    public function testGetterAndSetterTitle()
    {
        /**
         * @var $stub Notice
         */
        $stub = new Notice();

        $this->assertEquals(null, $stub->getTitle());

        $value = 'WP Kit Test Title';

        $this->assertEquals($stub, $stub->setTitle($value));
        $this->assertEquals($value, $stub->getTitle());

        $value = 'WP Kit <b>Test Title</b>';

        $this->assertEquals($stub, $stub->setTitle($value));
        $this->assertEquals($value, $stub->getTitle());
    }

    public function testGetterAndSetterContent()
    {
        /**
         * @var $stub Notice
         */
        $stub = new Notice();

        $this->assertEquals(null, $stub->getContent());

        $value = 'WP Kit Test Content';

        $this->assertEquals($stub, $stub->setContent($value));
        $this->assertEquals($value, $stub->getContent());

        $value = '<p>WP Kit <b>Test Content</b></p>';

        $this->assertEquals($stub, $stub->setContent($value));
        $this->assertEquals($value, $stub->getContent());
    }

    public function testGetterAndSetterDismissible()
    {
        /**
         * @var $stub Notice
         */
        $stub = new Notice();

        $this->assertFalse($stub->isDismissible());

        $value = true;

        $this->assertEquals($stub, $stub->setDismissible($value));
        $this->assertEquals($value, $stub->isDismissible());

        $value = false;

        $this->assertEquals($stub, $stub->setDismissible($value));
        $this->assertEquals($value, $stub->isDismissible());
    }

    public function testDisable()
    {
        /**
         * @var $stub Notice
         */
        $stub = new Notice();
        $relevantStorage = new RelevantStorageForTestsOption();
        $stub->setRelevantStorage($relevantStorage);
        $this->assertEquals($stub, $stub->disable());
        $this->assertFalse($relevantStorage->get());
    }

    public function testEnable()
    {
        /**
         * @var $stub Notice
         */
        $stub = new Notice();
        $relevantStorage = new RelevantStorageForTestsOption();
        $stub->setRelevantStorage($relevantStorage);
        $this->assertEquals($stub, $stub->enable());
        $this->assertTrue($relevantStorage->get());
    }
}
