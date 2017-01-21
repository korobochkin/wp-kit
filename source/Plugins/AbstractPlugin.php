<?php
namespace Korobochkin\WPKit\Plugins;

abstract class AbstractPlugin implements PluginInterface {

	/**
	 * @var string A path for plugin bootstrap file.
	 */
	protected $file;

	/**
	 * @return string
	 */
	public function getFile() {
		return $this->file;
	}

	/**
	 * @param string $file
	 */
	public function setFile( $file ) {
		$this->file = $file;
	}


}
