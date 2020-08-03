<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Themes;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AbstractTheme
 * @package Korobochkin\WPKit\Themes
 */
abstract class AbstractTheme implements ThemeInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function runAdmin()
    {
        return $this;
    }

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
    public function setContainer(ContainerInterface $container = null)
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
