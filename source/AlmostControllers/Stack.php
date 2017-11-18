<?php
namespace Korobochkin\WPKit\AlmostControllers;

use Korobochkin\WPKit\AlmostControllers\Exceptions\ActionNotFoundException;
use Korobochkin\WPKit\AlmostControllers\Exceptions\UnauthorizedException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Class Stack
 */
class Stack implements StackInterface
{
    /**
     * @var ActionInterface[]
     */
    protected $actions;

    /**
     * @var string WordPress action name.
     */
    protected $actionName;

    /**
     * @var ActionInterface Current action.
     */
    protected $currentAction;

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * @var \Symfony\Component\HttpFoundation\Response
     */
    protected $response;

    /**
     * @var ContainerInterface DI Container.
     */
    protected $container;

    /**
     * Stack constructor.
     *
     * @param ActionInterface[] $actions
     * @param string $actionName
     */
    public function __construct(array $actions, $actionName)
    {
        $this->actions    = $actions;
        $this->actionName = $actionName;
    }

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
    public function setActions(array $actions)
    {
        $this->actions = $actions;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addAction(ActionInterface $action)
    {
        $this->actions[$action->getName()] = $action;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @inheritdoc
     */
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;

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
    public function register()
    {
        if (empty($this->actions)) {
            throw new \LogicException('You need set actions before call register method.');
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function handleRequest()
    {
        try {
            $this->requestManager();
        } catch (ActionNotFoundException $exception) {
            $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (UnauthorizedException $exception) {
            $this->response->setStatusCode(Response::HTTP_FORBIDDEN);
        } catch (\Exception $exception) {
            if ($this->response->getStatusCode() < 300) {
                // Status code for unknown exceptions.
                $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } finally {
            $this->currentAction = null;
        }

        if ($this->response) {
            // Send response.
            $this->send();
        }
    }

    /**
     * Util for managing request.
     *
     * @throws UnauthorizedException If user not allowed to use this action.
     * @throws ActionNotFoundException If requested action not exists.
     *
     * @return $this For chain calls.
     */
    protected function requestManager()
    {
        // Remove slashes (added by WordPress).
        //TODO: check if $fragment is string here
        if (isset($_POST)) {
            $post = $_POST;
            if (is_array($post)) {
                foreach ($post as &$fragment) {
                    $fragment = stripslashes($fragment);
                }
                $this->request->request = new ParameterBag($post);
            }
            unset($post, $fragment);
        }

        // Find the requested action.
        $action = $this->request->request->get('actionName');
        if (!is_null($action) && isset($this->actions[$action])) {
            // Initialize the action.
            if (is_string($this->actions[$action])) {
                $this->actions[$action] = new $this->actions[$action]();
            }

            $this->currentAction = $this->actions[$action];

            if (is_user_logged_in()) {
                // For signed in users.
                if (!$this->currentAction->isEnabledForLoggedIn()) {
                    throw new UnauthorizedException();
                }
            } else {
                // For not signed in users
                if (!$this->currentAction->isEnabledForNotLoggedIn()) {
                    throw new UnauthorizedException();
                }
            }

            // Action should not overwrite response object.
            $this->currentAction
                ->setContainer($this->container);

            $this->currentAction
                ->setViolations(new ConstraintViolationList())
                ->setRequest($this->request)
                ->setResponse($this->response)
                ->handleRequest();

            return $this;
        } else {
            // Not supported action or action name invalid (null).
            throw new ActionNotFoundException();
        }
    }

    /**
     * @inheritdoc
     */
    public function send()
    {
        $this->response->send();

        // This code part of wp_send_json() function.
        if (defined('DOING_AJAX') && DOING_AJAX) {
            wp_die();
        } else {
            die;
        }
    }

    /**
     * @inheritdoc
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function get($id)
    {
        return $this->container->get($id);
    }
}
