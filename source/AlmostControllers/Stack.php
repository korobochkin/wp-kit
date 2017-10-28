<?php
namespace Korobochkin\WPKit\AlmostControllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Stack implements StackInterface
{

    /**
     * @var ActionInterface[]
     */
    protected $actions;

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * @var \Symfony\Component\HttpFoundation\Response
     */
    protected $response;

    /**
     * @inheritdoc
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @inheritdoc
     */
    public function setActions($actions)
    {
        $this->actions = $actions;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addAction(ActionInterface $action)
    {
        $actionName                 = get_class($action);
        $this->actions[$actionName] = $action;

        return $this;
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
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @inheritdoc
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function load()
    {
        if (empty($this->actions)) {
            return $this;
        }

        foreach ($this->actions as $action) {
            if ($action->isEnabledForLoggedIn()) {
                add_action('wp_ajax_'.$action->getName(), array($this, 'handleRequest'));
            }
            if ($action->isEnabledForNotLoggedIn()) {
                add_action('wp_ajax_nopriv_'.$action->getName(), array($this, 'handleRequest'));
            }

            $action->setApi($this);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function handleRequest()
    {
        if (isset($this->actions[$_REQUEST['action']])) {
            $this->actions[$_REQUEST['action']]->handleRequest();
        }
        $this->send();
    }

    /**
     * @inheritdoc
     */
    public function send()
    {
        $this->response->send();

        // This part grabbed from wp_send_json()
        if (defined('DOING_AJAX') && DOING_AJAX) {
            wp_die();
        } else {
            die;
        }
    }
}
