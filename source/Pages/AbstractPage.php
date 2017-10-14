<?php
namespace Korobochkin\WPKit\Pages;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractPage implements PageInterface
{
    /**
     * @var string Page name.
     */
    protected $name;

    /**
     * @var string Page title.
     */
    protected $pageTitle;

    /**
     * @var string Page menu title.
     */
    protected $menuTitle;

    /**
     * @var string Capability to access to the page.
     */
    protected $capability;

    /**
     * @var string Page menu slug.
     */
    protected $menuSlug;

    /**
     * @var Views\PageViewInterface Page view instance.
     */
    protected $view;

    /**
     * @var Request Current HTTP request.
     */
    protected $request;

    /**
     * @var FormFactoryInterface Form factory to building $form.
     */
    protected $formFactory;

    /**
     * @var FormInterface HTML Form.
     */
    protected $form;

    /**
     * @var object An object (instance) which holds the form data.
     */
    protected $formEntity;

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

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * @inheritdoc
     */
    public function setPageTitle($title)
    {
        $this->pageTitle = $title;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getMenuTitle()
    {
        return $this->menuTitle;
    }

    /**
     * @inheritdoc
     */
    public function setMenuTitle($title)
    {
        $this->menuTitle = $title;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCapability()
    {
        return $this->capability;
    }

    /**
     * @inheritdoc
     */
    public function setCapability($cap)
    {
        $this->capability = $cap;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getMenuSlug()
    {
        return $this->menuSlug;
    }

    /**
     * @inheritdoc
     */
    public function setMenuSlug($menuSlug)
    {
        $this->menuSlug = $menuSlug;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @inheritdoc
     */
    public function setView(Views\PageViewInterface $view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        $this->getView()->render($this);
    }

    /**
     * Method for enqueuing required JS and CSS files.
     */
    public function enqueueScriptStyles()
    {
    }

    /**
     * @inheritdoc
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @inheritdoc
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFormFactory()
    {
        return $this->formFactory;
    }

    /**
     * @inheritdoc
     */
    public function setFormFactory(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @inheritdoc
     */
    public function setForm(FormInterface $form)
    {
        $this->form = $form;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFormEntity()
    {
        return $this->formEntity;
    }

    /**
     * @inheritdoc
     */
    public function setFormEntity($formEntity)
    {
        $this->formEntity = $formEntity;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function handleRequest()
    {
    }
}
