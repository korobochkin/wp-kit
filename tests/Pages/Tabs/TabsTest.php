<?php
namespace Korobochkin\WPKit\Tests\Pages\Tabs;

use Korobochkin\WPKit\Pages\Tabs\Tab;
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

        $this->assertEquals(2, count($tabs));

        /*foreach($tabs as $tabName => $tabInstance) {

        }*/
    }
}
