<?php
namespace Korobochkin\WPKit\Themes;

interface ThemeInterface {

	/**
	 * Define const NAME here with plugin name as 'my-plugin-name-'.
	 *
	 * Define const VERSION here with plugin version as '1.2.3-beta-1'.
	 */

	/**
	 * The main function which runs everything. Place your add_action() or other functions call here.
	 */
	public function run();

	/**
	 * @param $file string A subpath + filename.
	 *
	 * @return string A path to theme root folder (where your functions.php file located).
	 */
	public function getDir($file);

	/**
	 * @param $file string A subpath + filename.
	 *
	 * @return string An URL to theme root folder (where you can place your style.css for example).
	 */
	public function getUrl($file);

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
