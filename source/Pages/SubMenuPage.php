<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Pages;

class SubMenuPage extends AbstractPage implements SubMenuPageInterface
{
    /**
     * @var string Slug of parent page.
     */
    protected $parentSlug;

    /**
     * @var MenuPageInterface Parent page.
     */
    protected $parentPage;

    /**
     * @inheritdoc
     */
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

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function unRegister()
    {
        $result = remove_submenu_page($this->getParentSlug(), $this->getMenuSlug());
        if (!$result) {
            throw new \Exception();
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
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
    public function getParentSlug()
    {
        return $this->parentSlug;
    }

    /**
     * @inheritdoc
     */
    public function setParentSlug($slug)
    {
        $this->parentSlug = $slug;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getParentPage()
    {
        return $this->parentPage;
    }

    /**
     * @inheritdoc
     */
    public function setParentPage(MenuPageInterface $page)
    {
        $this->parentPage = $page;
        return $this;
    }
}
