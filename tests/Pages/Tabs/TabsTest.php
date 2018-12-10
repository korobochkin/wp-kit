<?php
namespace Korobochkin\WPKit\Tests\Pages\Tabs;

use Korobochkin\WPKit\Pages\Tabs\Tab;
use Korobochkin\WPKit\Pages\Tabs\TabInterface;
use Korobochkin\WPKit\Pages\Tabs\Tabs;

/**
 * Class TabsTest
 */
class TabsTest extends \WP_UnitTestCase
{
    /**
     * @var Tabs
     */
    protected $stub;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        parent::setUp();
        $this->stub = new Tabs();
    }

    public function testIterator()
    {
        $tabs = $this->stub;

        $tab = new Tab();
        $tab->setName('test_1');
        $tabs->addTab($tab);

        $tab2 = new Tab();
        $tab2->setName('test_2');
        $tabs->addTab($tab2);

        $this->assertSame(2, count($tabs->getTabs()));

        foreach ($tabs as $tabName => $tabInstance) {
            $this->assertInstanceOf(TabInterface::class, $tabInstance);
            $this->assertContains($tabName, array('test_1', 'test_2'));
        }
    }

    public function testAddTabWithNoName()
    {
        $this->setExpectedException(\LogicException::class);
        $this->stub->addTab(new Tab());
    }

    public function testGetTab()
    {
        $tab = new Tab();
        $tab->setName('wp_kit_test_name');
        $this->stub->addTab($tab);

        $this->assertSame($tab, $this->stub->getTab('wp_kit_test_name'));
    }

    public function testGetTabWithWrongName()
    {
        $tab = new Tab();
        $tab->setName('wp_kit_test_name');
        $this->stub->addTab($tab);

        $this->setExpectedException(\InvalidArgumentException::class);
        $this->stub->getTab('not_exists_name');
    }

    public function testHasTab()
    {
        $tab = new Tab();
        $tab->setName('wp_kit_test_name');
        $this->stub->addTab($tab);

        $this->assertTrue($this->stub->hasTab('wp_kit_test_name'));
        $this->assertFalse($this->stub->hasTab('not_exists_name'));
    }
}
