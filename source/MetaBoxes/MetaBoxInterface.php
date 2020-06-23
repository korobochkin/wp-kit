<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\MetaBoxes;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface MetaBoxInterface
 */
interface MetaBoxInterface
{
    /**
     * Register Meta Box in WordPress.
     *
     * WARNING: In WordPress bellow 4.4 you cannot register one Meta Box instance
     * for multiple screens. This means that you cannot pass array in setScreen() method.
     *
     * @see add_meta_box
     *
     * @return $this For chain calls.
     */
    public function register();

    /**
     * Prepare Meta Box for rendering.
     *
     * @see render().
     *
     * @return $this For chain calls.
     */
    public function lateConstruct();

    /**
     * Returns Meta Box Id.
     *
     * @return string Meta Box unique Id.
     */
    public function getId();

    /**
     * Sets Meta Box Id.
     *
     * @param string $id Meta Box unique Id.
     *
     * @return $this For chain calls.
     */
    public function setId($id);

    /**
     * Returns Meta Box title for WordPress.
     *
     * @return string Meta Box title.
     */
    public function getTitle();

    /**
     * Sets Meta Box title for WordPress.
     *
     * @param string $title Meta Box title.
     *
     * @return $this For chain calls.
     */
    public function setTitle($title);

    /**
     * Returns view instance of Meta Box.
     *
     * @return MetaBoxViewInterface View instance.
     */
    public function getView();

    /**
     * Sets view instance of Meta Box.
     *
     * @param MetaBoxViewInterface $view View instance.
     *
     * @return $this For chain calls.
     */
    public function setView($view);

    /**
     * Returns list of screens where Meta Box should shown.
     *
     * @return string|string[] List of screens.
     */
    public function getScreen();

    /**
     * Sets list of screens where Meta Box should shown.
     *
     * WARNING: In WordPress bellow 4.4 you cannot register one Meta Box instance
     * for multiple screens. This means that you cannot pass array in setScreen() method.
     *
     * @see add_meta_box
     *
     * @param string|string[] $screen List of screens.
     *
     * @return $this For chain calls.
     */
    public function setScreen($screen);

    /**
     * Returns WordPress context.
     *
     * @return string Context for WordPress.
     */
    public function getContext();

    /**
     * Sets WordPress context.
     *
     * @param string $context Context for WordPress.
     *
     * @return $this For chain calls.
     */
    public function setContext($context);

    /**
     * Returns WordPress priority used for build order.
     *
     * @return string WordPress priority.
     */
    public function getPriority();

    /**
     * Sets WordPress priority used for build order.
     *
     * @param string $priority WordPress priority.
     *
     * @return $this For chain calls.
     */
    public function setPriority($priority);

    /**
     * Returns form factory.
     *
     * @return FormFactoryInterface Form factory.
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
     * Call method only from $this->lateConstruct()
     * to prevent illegal access.
     */
    public function handleRequest();

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
     * Render (output) the Meta Box markup.
     */
    public function render();
}
