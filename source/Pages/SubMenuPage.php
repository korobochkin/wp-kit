<?php
namespace Korobochkin\WPKit\Pages;

class SubMenuPage extends AbstractPage implements SubMenuPageInterface
{
    public function register()
    {
        $page = add_submenu_page(
            $this->getParentSlug(),
            $this->getPageTitle(),
            $this->getMenuTitle(),
            $this->getCapability(),
            $this->getMenuSlug(),
            array($this, 'render')
        );
        if ($page) {
            // All functions attached to actions runs in 2 scenarios:
            // 1. Particular settings page loaded (load-$page action).
            // 2. When page settings is saving (admin_action_update action)

            // Fully build the page object
            add_action('load-'.$page, array($this, 'lateConstruct'));
            add_action('admin_action_update', array($this, 'lateConstruct'));
        }
    }

    public function unRegister()
    {
        remove_submenu_page($this->getParentSlug(), $this->getMenuSlug());
    }

    public function getURL()
    {
        return add_query_arg(
            'page',
            $this->getMenuSlug(),
            admin_url('admin.php')
        );
    }
}
