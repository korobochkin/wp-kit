<?php
namespace Korobochkin\WPKit\Pages;

use Korobochkin\WPKit\Pages\Views\PageViewInterface;

interface PageInterface
{
    public function lateConstruct();

    public function register();

    public function unRegister();

    public function getName();

    public function setName($name);

    public function getPageTitle();

    public function setPageTitle($title);

    public function getMenuTitle();

    public function setMenuTitle($title);

    public function getCapability();

    public function setCapability($capability);

    public function getMenuSlug();

    public function setMenuSlug($menuSlug);

    public function getView();

    public function setView(PageViewInterface $view);

    public function getURL();

    public function render();

    public function setParentPage(MenuPageInterface $page);

    public function getParentPage();
}
