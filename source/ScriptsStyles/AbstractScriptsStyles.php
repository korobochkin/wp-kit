<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\ScriptsStyles;

/**
 * Class AbstractScriptsStyles
 */
abstract class AbstractScriptsStyles implements ScriptsStylesInterface
{
    /**
     * @var string Base url where to your assets folder.
     */
    protected $baseUrl;

    /**
     * @var bool Developer mode status. Used for enqueue non min files.
     */
    protected $dev;

    /**
     * ScriptsStyles constructor.
     *
     * @param string $baseUrl Base url to assets folder.
     * @param bool $dev Status of developer mode.
     */
    public function __construct($baseUrl, $dev)
    {
        $this->baseUrl = $baseUrl;
        $this->dev     = $dev;
    }

    /**
     * @inheritdoc
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @inheritdoc
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isDev()
    {
        return $this->dev;
    }

    /**
     * @inheritdoc
     */
    public function setDev($dev)
    {
        $this->dev = $dev;
        return $this;
    }
}
