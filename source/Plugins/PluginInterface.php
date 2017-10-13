<?php
namespace Korobochkin\WPKit\Plugins;

use Symfony\Component\DependencyInjection\ContainerBuilder;

interface PluginInterface
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
     * The main function which runs everything. Place your add_action() or other functions call here.
     *
     * @return $this For chain calls.
     */
    public function run();

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
     * @return ContainerBuilder Dependency Injection container with services.
     */
    public function getContainer();

    /**
     * @param ContainerBuilder $container Dependency Injection container with services.
     *
     * @return $this For chain calls.
     */
    public function setContainer(ContainerBuilder $container);

    /**
     * @return string A path to plugin root folder (where your bootstrap file located).
     */
    public function getDir();

    /**
     * @return string An URL to plugin root folder (where you can place your assets folder for example).
     */
    public function getUrl();

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
