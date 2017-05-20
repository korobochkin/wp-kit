<?php
namespace Korobochkin\WPKit\Plugins;

abstract class AbstractPlugin implements PluginInterface {

	/**
	 * @var string A path to plugin bootstrap file.
	 */
	protected $file;

	/**
	 * @inheritdoc
	 */
	public function __construct($file) {
		$this->setFile($file);
	}

	/**
	 * @inheritdoc
	 */
	abstract public function run();

	/**
	 * @inheritdoc
	 */
	public function getFile() {
		return $this->file;
	}

	/**
	 * @inheritdoc
	 */
	public function setFile($file) {
		$this->file = $file;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getDir() {
		return plugin_dir_path($this->getFile());
	}

	/**
	 * @inheritdoc
	 */
	public function getUrl() {
		return plugin_dir_url($this->getFile());
	}
}
