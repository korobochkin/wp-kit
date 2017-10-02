<?php
namespace Korobochkin\WPKit\Pages;

class VirtualMenuPage extends MenuPage implements VirtualMenuPageInterface
{
    /**
     * @var MenuPageInterface Page instance which is used by this virtual page.
     */
    protected $virtualPage;

    /**
     * @return MenuPageInterface
     */
    public function getVirtualPage()
    {
        return $this->virtualPage;
    }

    /**
     * @param MenuPageInterface $virtualPage
     *
     * @return $this For chain calls.
     */
    public function setVirtualPage(MenuPageInterface $virtualPage)
    {
        $this->virtualPage = $virtualPage;
        return $this;
    }

    public function render()
    {
        $this->getVirtualPage()->render();
    }

    public function lateConstruct()
    {
        $this->getVirtualPage()->lateConstruct();
    }
}
