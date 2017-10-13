<?php
namespace Korobochkin\WPKit\Themes;

/**
 * Class AbstractTheme
 * @package Korobochkin\WPKit\Themes
 */
abstract class AbstractTheme implements ThemeInterface
{
    /**
     * @var ContainerBuilder
     */
    protected $container;

    /**
     * @inheritdoc
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @inheritdoc
     */
    public function setContainer(ContainerBuilder $container)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDir()
    {
        $path = get_stylesheet_directory();

        return $path;
    }

    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        $uri = get_stylesheet_directory_uri();

        return $uri;
    }
}
