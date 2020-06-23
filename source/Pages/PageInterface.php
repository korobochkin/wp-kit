<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Pages;

use Korobochkin\WPKit\Pages\Views\PageViewInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
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
     * Called only if user can see this page (have required capability).
     *
     * Validation process in wp-admin/includes/menu.php
     * 1. admin.php:138
     * 2. require(ABSPATH . 'wp-admin/menu.php') (138 line)
     * 3. require_once(ABSPATH . 'wp-admin/includes/menu.php') (282 line).
     * 4. if ( !user_can_access_admin_page() ) (333 line).
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
     * Sets name of the page.
     *
     * @param $name string Name of the page.
     *
     * @return $this For chain calls.
     */
    public function setName($name);

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
     * Sets the menu page title.
     *
     * @param $title string Menu title of the page.
     *
     * @return $this For chain calls.
     */
    public function setMenuTitle($title);

    /**
     * Returns capability needed to access to the page.
     *
     * @return string Capability.
     */
    public function getCapability();

    /**
     * Sets capability needed to access to the page.
     *
     * @param $capability string WordPress capability.
     *
     * @return $this For chain calls.
     */
    public function setCapability($capability);

    /**
     * Returns page menu slug.
     *
     * Used in URL.
     *
     * @return string Menu slug.
     */
    public function getMenuSlug();

    /**
     * Sets page menu slug.
     *
     * @param $menuSlug string Menu slug.
     *
     * @return $this For chain calls.
     */
    public function setMenuSlug($menuSlug);

    /**
     * Returns page view instance.
     *
     * This instance will render the page.
     *
     * @return PageViewInterface Page view instance.
     */
    public function getView();

    /**
     * Sets page view instance.
     *
     * @param PageViewInterface $view Page view.
     *
     * @return $this For chain calls.
     */
    public function setView(PageViewInterface $view);

    /**
     * Render the page with PageView instance.
     *
     * This method outputting HTML.
     */
    public function render();

    /**
     * Returns HTTP request.
     *
     * @return Request HTTP Request.
     */
    public function getRequest();

    /**
     * Sets HTTP request.
     *
     * @param Request $request HTTP request.
     *
     * @return $this For chain calls.
     */
    public function setRequest(Request $request);

    /**
     * Register the page in WordPress Pages-Settings API.
     *
     * After calling this method the page available in WordPress.
     *
     * @return $this For chain calls.
     */
    public function register();

    /**
     * Un register the page in WordPress Pages-Settings API.
     *
     * @throws \Exception If page not removed (WordPress not found this page as registered page).
     *
     * @return $this For chain calls.
     */
    public function unRegister();

    /**
     * Returns the page url.
     *
     * @return string The page url.
     */
    public function getURL();

    /** The methods bellow used to work with forms. */

    /**
     * Returns form factory.
     *
     * @return FormFactoryInterface Form factory for building forms.
     */
    public function getFormFactory();

    /**
     * Sets the form factory to build forms.
     *
     * @param $formFactory FormFactoryInterface Form factory.
     *
     * @return $this For chain calls.
     */
    public function setFormFactory(FormFactoryInterface $formFactory);

    /**
     * Returns the form for this page.
     *
     * @return FormInterface HTML form.
     */
    public function getForm();

    /**
     * Sets the form for this page.
     *
     * @param FormInterface $form HTML form.
     *
     * @return $this For chain calls.
     */
    public function setForm(FormInterface $form);

    /**
     * Returns the form data entity.
     *
     * @return object Form entity.
     */
    public function getFormEntity();

    /**
     * Sets the form entity.
     *
     * @param object $formEntity form data-entity.
     *
     * @return $this For chain calls.
     */
    public function setFormEntity($formEntity);

    /**
     * Returns tabs.
     *
     * @return Tabs\TabsInterface Tabs for page.
     */
    public function getTabs();

    /**
     * Sets tabs.
     *
     * @param Tabs\TabsInterface $tabs Tabs for page.
     *
     * @return $this For chain calls.
     */
    public function setTabs(Tabs\TabsInterface $tabs);

    /**
     * Be sure to call it only from $this->lateConstruct()
     * to prevent illegal access to the page handling.
     */
    public function handleRequest();
}
