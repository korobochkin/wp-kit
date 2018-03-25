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
    public function testIterator()
    {
        $tabs = new Tabs();

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
}
