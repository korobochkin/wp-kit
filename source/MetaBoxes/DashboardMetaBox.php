<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\MetaBoxes;

/**
 * Class AbstractDashboardMetaBox
 */
class DashboardMetaBox extends MetaBox
{
    /**
     * @inheritdoc
     */
    public function register()
    {
        wp_add_dashboard_widget(
            $this->getId(),
            $this->getTitle(),
            array($this, 'render')
        );

        add_action('load-index.php', array($this, 'lateConstruct'));

        return $this;
    }
}
