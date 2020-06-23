<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Pages;

use Korobochkin\WPKit\Pages\Tabs\TabsInterface;
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
     * @var TabsInterface Tabs.
     */
    protected $tabs;

    /**
     * @inheritdoc
     */
    public function lateConstruct()
    {
        return $this;
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
    public function getTabs()
    {
        return $this->tabs;
    }

    /**
     * @inheritdoc
     */
    public function setTabs(Tabs\TabsInterface $tabs)
    {
        $this->tabs = $tabs;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function handleRequest()
    {
    }
}
