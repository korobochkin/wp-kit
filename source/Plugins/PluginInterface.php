<?php
namespace Korobochkin\WPKit\Plugins;

interface PluginInterface {

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
	 */
	public function run();

	/**
	 * @return string A path to plugin bootstrap file.
	 */
	public function getFile();

	/**
	 * @param $file string A path to plugin bootstrap file.
	 */
	public function setFile($file);

	/**
	 * @return string A path to plugin root folder (where your bootstrap file located).
	 */
	public function getDir();

	/**
	 * @return string An URL to plugin root folder (where you can place your assets folder for example).
	 */
	public function getUrl();
}
