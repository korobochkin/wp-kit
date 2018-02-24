<?php
namespace Korobochkin\WPKit\Tests\Notices;

use Korobochkin\WPKit\Notices\Notice;
use Korobochkin\WPKit\Notices\NoticeView;

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
        $stub = new Notice();

        $this->assertEquals(null, $stub->getName());

        $value = 'wp_kit_test_notice_name';

        $this->assertEquals($stub, $stub->setName($value));
        $this->assertEquals($value, $stub->getName());
    }

    public function testGetterAndSetterTitle()
    {
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
        $stub            = new Notice();
        $relevantStorage = new RelevantStorageForTestsOption();
        $stub->setRelevantStorage($relevantStorage);
        $this->assertEquals($stub, $stub->disable());
        $this->assertFalse($relevantStorage->get());
    }

    public function testEnable()
    {
        $stub            = new Notice();
        $relevantStorage = new RelevantStorageForTestsOption();
        $stub->setRelevantStorage($relevantStorage);
        $this->assertEquals($stub, $stub->enable());
        $this->assertTrue($relevantStorage->get());
    }

    public function testGetterAndSetterRelevantStorage()
    {
        $stub = new Notice();

        $this->assertNull($stub->getRelevantStorage());

        $value = new RelevantStorageForTestsOption();

        $this->assertEquals($stub, $stub->setRelevantStorage($value));
        $this->assertEquals($value, $stub->getRelevantStorage());
    }

    public function testIsRelevant()
    {
        /**
         * @var $stub Notice
         */
        $stub = new Notice();
        $this->assertTrue($stub->isRelevant());

        $value = new RelevantStorageForTestsOption();
        $stub->setRelevantStorage($value);

        $this->assertTrue($stub->isRelevant());

        $value->updateValue(false);

        $this->assertFalse($stub->isRelevant());
    }

    public function testGetterAndSetterView()
    {
        $stub = new Notice();

        $this->assertNull($stub->getView());

        $value = new NoticeView();

        $this->assertEquals($stub, $stub->setView($value));
        $this->assertEquals($value, $stub->getView());
    }

    public function testRender()
    {
        $stub = new Notice();
        $view = new NoticeView();
        $stub->setView($view);

        $this->assertInternalType('string', $stub->render());
    }
}
