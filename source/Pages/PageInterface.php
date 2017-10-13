<?php
namespace Korobochkin\WPKit\Pages;

use Korobochkin\WPKit\Pages\Views\PageViewInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface PageInterface represents single admin page in WordPress.
 *
 * Use this interface to create your page or use predefined classes which implements
 * this interface.
 */
interface PageInterface
{
    /**
     * Called to late construct the page instance.
     *
     * Usually defining priority of calling this method defined in register method.
     *
     * @see register
     *
     * @return $this For chain calls.
     */
    public function lateConstruct();

    /**
     * Returns name of the page.
     *
     * @return string Name of the page.
     */
    public function getName();

    /**
     * Setups name of the page.
     *
     * @param $name string Name of the page.
     *
     * @return $this For chain calls.
     */
    public function setName($name);

    public function setParentPage(MenuPageInterface $page);

    public function getParentPage();

    /**
     * Returns the page title.
     *
     * @return string Title of the page.
     */
    public function getPageTitle();

    /**
     * Setups the page title.
     *
     * @param $title string Title of the page.
     *
     * @return $this For chain calls.
     */
    public function setPageTitle($title);

    /**
     * Returns the menu page title.
     *
     * Used as label (title) in WordPress aside menu.
     *
     * @return string Menu title of the page.
     */
    public function getMenuTitle();

    /**
     * @param $title string Menu title of the page.
     *
     * @return $this For chain calls.
     */
    public function setMenuTitle($title);

    public function getCapability();

    public function setCapability($capability);

    public function getMenuSlug();

    public function setMenuSlug($menuSlug);

    public function getView();

    public function setView(PageViewInterface $view);

    public function render();

    /**
     * @return Request
     */
    public function getRequest();

    /**
     * @param Request $request HTTP request.
     *
     * @return $this For chain calls.
     */
    public function setRequest(Request $request);

    public function register();

    public function unRegister();

    public function getURL();

    /**
     * @return FormFactoryInterface
     */
    public function getFormFactory();

    /**
     * @param $formFactory FormFactoryInterface
     *
     * @return $this For chain calls.
     */
    public function setFormFactory(FormFactoryInterface $formFactory);
}
