<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Plugins;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

interface PluginInterface extends ContainerAwareInterface
{
    /**
     * Define const NAME here with plugin name as 'my-plugin-name-'.
     *
     * Define const VERSION here with plugin version as '1.2.3-beta-1'.
     */

    /**
     * PluginInterface constructor.
     *
     * Do not set any actions or hooks here.
     *
     * @param $file string Path to plugin bootstrap file.
     */
    public function __construct($file);

    /**
     * Place here any action and filters which initialize plugin.
     *
     * @return $this For chain calls.
     */
    public function run();

    /**
     * Place here any actions and filters for WordPress admin area only.
     *
     * @return $this For chain calls.
     */
    public function runAdmin();

    /**
     * @return string A path to plugin bootstrap file.
     */
    public function getFile();

    /**
     * @param $file string A path to plugin bootstrap file.
     *
     * @return $this For chain calls.
     */
    public function setFile($file);

    /**
     * Returns the ContainerBuilder instance used to store services.
     *
     * @return ContainerInterface Dependency Injection container with services.
     */
    public function getContainer();

    /**
     * Sets the ContainerBuilder instance used to store services.
     *
     * @param ContainerInterface $container Dependency Injection container with services.
     *
     * @return $this For chain calls.
     */
    public function setContainer(ContainerInterface $container = null);

    /**
     * Returns the plugin folder name.
     *
     * @return string A path to plugin root folder (where your bootstrap file located).
     */
    public function getDir();

    /**
     * Returns the plugin folder url.
     *
     * @return string An URL to plugin root folder (where you can place your assets folder for example).
     */
    public function getUrl();

    /**
     * Returns the plugin basename.
     *
     * @return string Plugin basename (the plugin name in plugins directory).
     */
    public function getBasename();

    /**
     * Returns plugin version as a string which you can parse.
     *
     * @return string Version of plugin in sem ver manner.
     */
    public function getVersion();

    /**
     * Returns plugin name as a string.
     *
     * Perfect for your plugin text domain.
     *
     * @return string Plugin name in 'your-plugin-name' manner.
     */
    public function getName();
}
