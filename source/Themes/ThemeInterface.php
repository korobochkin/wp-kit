<?php
namespace Korobochkin\WPKit\Themes;

interface ThemeInterface
{
    /**
     * Define const NAME here with plugin name as 'my-plugin-name-'.
     *
     * Define const VERSION here with plugin version as '1.2.3-beta-1'.
     */

    /**
     * The main function which runs everything. Place your add_action() or other functions call here.
     *
     * @return $this For chain calls.
     */
    public function run();

    /**
     * Returns the ContainerBuilder instance used to store services.
     *
     * @return ContainerBuilder Dependency Injection container with services.
     */
    public function getContainer();

    /**
     * Sets the ContainerBuilder instance used to store services.
     *
     * @param ContainerBuilder $container Dependency Injection container with services.
     *
     * @return $this For chain calls.
     */
    public function setContainer(ContainerBuilder $container);

    /**
     * The theme folder path.
     *
     * @return string A path to theme root folder (where your functions.php file located).
     */
    public function getDir();

    /**
     * The theme folder URL.
     *
     * @return string An URL to theme root folder (where your style.css exists).
     */
    public function getUrl();

    /**
     * Returns theme version as a string which you can parse.
     *
     * @return string Version of theme in sem ver manner.
     */
    public function getVersion();

    /**
     * Returns theme name as a string.
     *
     * Perfect for your theme text domain.
     *
     * @return string Theme name in 'your-theme-name' manner.
     */
    public function getName();
}
