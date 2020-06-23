<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Plugins;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AbstractPlugin
 * @package Korobochkin\WPKit\Plugins
 */
abstract class AbstractPlugin implements PluginInterface
{
    /**
     * @var string A path to plugin bootstrap file.
     */
    protected $file;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @inheritdoc
     */
    public function __construct($file)
    {
        $this->setFile($file);
    }

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
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @inheritdoc
     */
    public function setFile($file)
    {
        $this->file = $file;

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
        return plugin_dir_path($this->getFile());
    }

    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        return plugin_dir_url($this->getFile());
    }

    /**
     * @inheritdoc
     */
    public function getBasename()
    {
        return plugin_basename($this->getFile());
    }
}
