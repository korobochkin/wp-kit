<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Pages;

/**
 * Class VirtualMenuPage
 */
class VirtualMenuPage extends MenuPage implements VirtualMenuPageInterface
{
    /**
     * @var MenuPageInterface Page instance which is used by this virtual page.
     */
    protected $virtualPage;

    /**
     * Returns virtual page.
     *
     * @return MenuPageInterface Page instance.
     */
    public function getVirtualPage()
    {
        return $this->virtualPage;
    }

    /**
     * Sets virtual page.
     *
     * @param MenuPageInterface $page Page instance.
     *
     * @return $this For chain calls.
     */
    public function setVirtualPage(MenuPageInterface $page)
    {
        $this->virtualPage = $page;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        $this->getVirtualPage()->render();
    }

    /**
     * @inheritdoc
     */
    public function lateConstruct()
    {
        $this->getVirtualPage()->lateConstruct();
        return $this;
    }
}
