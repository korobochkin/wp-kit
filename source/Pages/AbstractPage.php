<?php
namespace Korobochkin\WPKit\Pages;

use Symfony\Component\HttpFoundation\Request;

abstract class AbstractPage implements PageInterface
{
    /**
     * @var string Name for the page.
     */
    protected $name;

    /**
     * @var string
     */
    protected $parentSlug;

    /**
     * @var MenuPageInterface
     */
    protected $parentPage;

    /**
     * @var string
     */
    protected $pageTitle;

    /**
     * @var string
     */
    protected $menuTitle;

    /**
     * @var string
     */
    protected $capability;

    /**
     * @var string
     */
    protected $menuSlug;

    /**
     * @var Views\PageViewInterface
     */
    protected $view;

    /**
     * @var Request Current HTTP request.
     */
    protected $request;

    /**
     * Called only if user can see this page (have required capability).
     *
     * Validation process in wp-admin/includes/menu.php
     * 1. admin.php:138
     * 2. require(ABSPATH . 'wp-admin/menu.php') (138 line)
     * 3. require_once(ABSPATH . 'wp-admin/includes/menu.php') (282 line).
     * 4. if ( !user_can_access_admin_page() ) (333 line).
     */
    public function lateConstruct()
    {
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getParentSlug()
    {
        return $this->parentSlug;
    }

    public function setParentSlug($slug)
    {
        $this->parentSlug = $slug;
        return $this;
    }

    /**
     * @return MenuPageInterface
     */
    public function getParentPage()
    {
        return $this->parentPage;
    }

    public function setParentPage(MenuPageInterface $page)
    {
        $this->parentPage = $page;
        return $this;
    }

    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    public function setPageTitle($title)
    {
        $this->pageTitle = $title;
        return $this;
    }

    public function getMenuTitle()
    {
        return $this->menuTitle;
    }

    public function setMenuTitle($title)
    {
        $this->menuTitle = $title;
        return $this;
    }

    public function getCapability()
    {
        return $this->capability;
    }

    public function setCapability($cap)
    {
        $this->capability = $cap;
        return $this;
    }

    public function getMenuSlug()
    {
        return $this->menuSlug;
    }

    public function setMenuSlug($menuSlug)
    {
        $this->menuSlug = $menuSlug;
        return $this;
    }

    public function getView()
    {
        return $this->view;
    }

    public function setView(Views\PageViewInterface $view)
    {
        $this->view = $view;
        return $this;
    }

    public function render()
    {
        $this->getView()->render($this);
    }

    public function enqueueScriptStyles()
    {
    }

    /**
     * @return Request HTTP request.
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request HTTP request.
     *
     * @return $this For chain calls.
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }
}
