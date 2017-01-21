<?php
namespace Korobochkin\WPKit\Theme;

abstract class AbstractTheme implements ThemeInterface {

	/**
	 * @inheritdoc
	 */
	abstract public function run();

	/**
	 * @inheritdoc
	 */
	public function getDir($file) {
		$path = get_stylesheet_directory();
		if($file) {
			return $path . $file;
		}
		return $path;
	}

	/**
	 * @inheritdoc
	 */
	public function getUrl($file) {
		$uri = get_stylesheet_directory_uri();
		if($file) {
			return $uri . esc_url($file);
		}
		return $uri;
	}
}
