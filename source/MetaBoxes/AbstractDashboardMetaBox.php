<?php
namespace Korobochkin\WPKit\MetaBoxes;

/**
 * Class AbstractDashboardMetaBox
 */
class AbstractDashboardMetaBox extends AbstractMetaBox
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
