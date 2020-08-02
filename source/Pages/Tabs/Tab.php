<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Pages\Tabs;

/**
 * Class Tab
 */
class Tab implements TabInterface
{
    /**
     * @var string Tab name.
     */
    protected $name;

    /**
     * @var string Tab title.
     */
    protected $title;

    /**
     * @var string Tab url.
     */
    protected $url;

    /**
     * @var bool Tab status.
     */
    protected $active;

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @inheritdoc
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @inheritdoc
     */
    public function markActive()
    {
        $this->active = true;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function markUnActive()
    {
        $this->active = false;
        return $this;
    }
}
