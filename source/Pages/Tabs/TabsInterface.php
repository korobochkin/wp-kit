<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Pages\Tabs;

/**
 * Interface PageTabsInterface
 */
interface TabsInterface extends \Iterator
{
    /**
     * @return TabInterface[]
     */
    public function getTabs();

    /**
     * @param TabInterface $tab Tab.
     *
     * @throws \LogicException If tab don't have a name.
     *
     * @return $this For chain calls.
     */
    public function addTab(TabInterface $tab);

    /**
     * Returns single tab instance if they exists.
     *
     * @param $name string Name of the tab.
     *
     * @throws \InvalidArgumentException If tab not exists.
     *
     * @return TabInterface Tab.
     */
    public function getTab($name);

    /**
     * @param $name string Tab name.
     *
     * @return boolean True if tab exists.
     */
    public function hasTab($name);
}
