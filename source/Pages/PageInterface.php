<?php
namespace Korobochkin\WPKit\Pages;

use Korobochkin\WPKit\Pages\Views\PageViewInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface PageInterface
{
    public function lateConstruct();

    public function getName();

    public function setName($name);

    public function setParentPage(MenuPageInterface $page);

    public function getParentPage();

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
