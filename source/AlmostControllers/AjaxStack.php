<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\AlmostControllers;

/**
 * Class AjaxStack
 *
 * Handle AJAX requests.
 */
class AjaxStack extends Stack
{
    /**
     * @inheritdoc
     */
    public function register()
    {
        if (empty($this->actions)) {
            throw new \LogicException('You need set actions before call register method.');
        }

        add_action('wp_ajax_'.$this->actionName, array($this, 'handleRequest'));
        add_action('wp_ajax_nopriv_'.$this->actionName, array($this, 'handleRequest'));

        return $this;
    }
}
