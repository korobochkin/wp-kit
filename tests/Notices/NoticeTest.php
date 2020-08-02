<?php
declare(strict_types=1);

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
        $this->assertSame($stub, $stub->lateConstruct());
        $this->assertInstanceOf(Notice::class, $stub->lateConstruct());
    }

    public function testGetterAndSetterName()
    {
        $stub = new Notice();

        $this->assertSame(null, $stub->getName());

        $value = 'wp_kit_test_notice_name';

        $this->assertSame($stub, $stub->setName($value));
        $this->assertSame($value, $stub->getName());
    }

    public function testGetterAndSetterTitle()
    {
        $stub = new Notice();

        $this->assertSame(null, $stub->getTitle());

        $value = 'WP Kit Test Title';

        $this->assertSame($stub, $stub->setTitle($value));
        $this->assertSame($value, $stub->getTitle());

        $value = 'WP Kit <b>Test Title</b>';

        $this->assertSame($stub, $stub->setTitle($value));
        $this->assertSame($value, $stub->getTitle());
    }

    public function testGetterAndSetterContent()
    {
        $stub = new Notice();

        $this->assertSame(null, $stub->getContent());

        $value = 'WP Kit Test Content';

        $this->assertSame($stub, $stub->setContent($value));
        $this->assertSame($value, $stub->getContent());

        $value = '<p>WP Kit <b>Test Content</b></p>';

        $this->assertSame($stub, $stub->setContent($value));
        $this->assertSame($value, $stub->getContent());
    }

    public function testGetterAndSetterDismissible()
    {
        $stub = new Notice();

        $this->assertFalse($stub->isDismissible());

        $value = true;

        $this->assertSame($stub, $stub->setDismissible($value));
        $this->assertSame($value, $stub->isDismissible());

        $value = false;

        $this->assertSame($stub, $stub->setDismissible($value));
        $this->assertSame($value, $stub->isDismissible());
    }

    public function testDisable()
    {
        $stub            = new Notice();
        $relevantStorage = new RelevantStorageForTestsOption();
        $stub->setRelevantStorage($relevantStorage);
        $this->assertSame($stub, $stub->disable());
        $this->assertFalse($relevantStorage->get());
    }

    public function testEnable()
    {
        $stub            = new Notice();
        $relevantStorage = new RelevantStorageForTestsOption();
        $stub->setRelevantStorage($relevantStorage);
        $this->assertSame($stub, $stub->enable());
        $this->assertTrue($relevantStorage->get());
    }

    public function testGetterAndSetterRelevantStorage()
    {
        $stub = new Notice();

        $this->assertNull($stub->getRelevantStorage());

        $value = new RelevantStorageForTestsOption();

        $this->assertSame($stub, $stub->setRelevantStorage($value));
        $this->assertSame($value, $stub->getRelevantStorage());
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

        $this->assertSame($stub, $stub->setView($value));
        $this->assertSame($value, $stub->getView());
    }

    public function testRender()
    {
        $stub = new Notice();
        $view = new NoticeView();
        $stub->setView($view);

        ob_start();
        $stub->render();
        $content = ob_get_contents();
        ob_end_clean();
        $this->assertInternalType('string', $content);
    }
}
