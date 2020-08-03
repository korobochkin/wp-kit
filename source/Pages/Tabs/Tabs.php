<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Pages\Tabs;

/**
 * Class Tabs
 */
class Tabs implements TabsInterface
{
    /**
     * @var TabInterface[]
     */
    protected $tabs = array();

    /**
     * @inheritdoc
     */
    public function getTabs()
    {
        return $this->tabs;
    }

    /**
     * @inheritdoc
     */
    public function addTab(TabInterface $tab)
    {
        if (empty($tab->getName())) {
            throw new \LogicException();
        }

        $this->tabs[$tab->getName()] = $tab;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTab($name)
    {
        if ($this->hasTab($name)) {
            return $this->tabs[$name];
        }
        throw new \InvalidArgumentException();
    }

    /**
     * @inheritdoc
     */
    public function hasTab($name)
    {
        if (isset($this->tabs[$name])) {
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function rewind()
    {
        reset($this->tabs);
    }

    /**
     * @inheritdoc
     */
    public function current()
    {
        return current($this->tabs);
    }

    /**
     * @inheritdoc
     */
    public function key()
    {
        return key($this->tabs);
    }

    /**
     * @inheritdoc
     */
    public function next()
    {
        next($this->tabs);
    }

    /**
     * @inheritdoc
     */
    public function valid()
    {
        return isset($this->tabs[$this->key()]);
    }
}
