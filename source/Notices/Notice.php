<?php
namespace Korobochkin\WPKit\Notices;

use Korobochkin\WPKit\DataComponents\NodeInterface;

/**
 * Class Notice
 */
class Notice implements NoticeInterface
{
    /**
     * @var string Notice name.
     */
    protected $name;

    /**
     * @var boolean Can this notice be disabled?
     */
    protected $dismissible = false;

    /**
     * @var NodeInterface Storage which store state (enabled-disabled).
     */
    protected $relevantStorage;

    /**
     * @var NoticeViewInterface Notice view instance.
     */
    protected $view;

    /**
     * @inheritdoc
     */
    public function lateConstruct()
    {
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isDismissible()
    {
        return $this->dismissible;
    }

    /**
     * @inheritdoc
     */
    public function setDismissible($dismissible)
    {
        $this->dismissible = $dismissible;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function disable()
    {
        $this
            ->getRelevantStorage()
                ->setLocalValue(false)
                ->flush();

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function enable()
    {
        $this
            ->getRelevantStorage()
                ->setLocalValue(true)
                ->flush();

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getRelevantStorage()
    {
        return $this->relevantStorage;
    }

    /**
     * @inheritdoc
     */
    public function setRelevantStorage(NodeInterface $relevantStorage)
    {
        $this->relevantStorage = $relevantStorage;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isRelevant()
    {
        if (isset($this->relevantStorage)) {
            return (bool) $this->relevantStorage->get();
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @inheritdoc
     */
    public function setView(NoticeViewInterface $view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        $this->getView()->render($this);
    }
}
