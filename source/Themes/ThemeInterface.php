<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Themes;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

interface ThemeInterface extends ContainerAwareInterface
{
    /**
     * Define const NAME here with plugin name as 'my-plugin-name-'.
     *
     * Define const VERSION here with plugin version as '1.2.3-beta-1'.
     */

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
     * Returns the ContainerInterface instance used to store services.
     *
     * @return ContainerInterface Dependency Injection container with services.
     */
    public function getContainer();

    /**
     * Sets the ContainerInterface instance used to store services.
     *
     * @param ContainerInterface $container Dependency Injection container with services.
     *
     * @return $this For chain calls.
     */
    public function setContainer(ContainerInterface $container = null);

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
