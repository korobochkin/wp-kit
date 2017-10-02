<?php
namespace Korobochkin\WPKit\Pages;

class MenuPage extends AbstractPage implements MenuPageInterface
{
    /**
     * @var string Url to icon or short name of icon or base-64 icon.
     */
    protected $icon;

    /**
     * @var int Position in the menu.
     */
    protected $position;

    public function register()
    {
        $page = add_menu_page(
            $this->getPageTitle(),
            $this->getMenuTitle(),
            $this->getCapability(),
            $this->getMenuSlug(),
            array($this, 'render'),
            $this->getIcon(),
            $this->getPosition()
        );

        // All functions attached to actions runs in 2 scenarios:
        // 1. Particular settings page loaded (load-$page action).
        // 2. When page settings is saving (admin_action_update action)

        // Fully build the page object
        add_action('load-'.$page, array($this, 'lateConstruct'));
        add_action('admin_action_update', array($this, 'lateConstruct'));

        add_action('admin_enqueue_scripts', array($this, 'enqueueScriptStyles'));
    }

    public function unRegister()
    {
        return remove_menu_page($this->getMenuSlug());
    }

    public function getURL()
    {
        return add_query_arg(
            'page',
            $this->getMenuSlug(),
            admin_url('admin.php')
        );
    }

    /**
     * @inheritdoc
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @inheritdoc
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @inheritdoc
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }
}
