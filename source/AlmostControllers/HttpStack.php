<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\AlmostControllers;

/**
 * Class HttpStack
 *
 * Handle HTTP requests addressed to wp-admin/admin-post.php.
 */
class HttpStack extends Stack
{
    /**
     * @inheritdoc
     */
    public function register()
    {
        if (empty($this->actions)) {
            throw new \LogicException('You need set actions before call register method.');
        }

        add_action('admin_post_'        . $this->actionName, array($this, 'handleRequest'));
        add_action('admin_post_nopriv_' . $this->actionName, array($this, 'handleRequest'));

        return $this;
    }
}
