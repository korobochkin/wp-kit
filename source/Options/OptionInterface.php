<?php
namespace Korobochkin\WPKit\Options;

use Korobochkin\WPKit\DataComponents\NodeInterface;

/**
 * Interface OptionInterface
 *
 * Represent single option with non nested values.
 *
 * @package Korobochkin\WPKit\Options
 */
interface OptionInterface extends NodeInterface {

	/**
	 * Describes if this option should be autoloaded by WordPress or not.
	 *
	 * @return bool true if it autoloaded, false otherwise.
	 */
	public function isAutoload();

	/**
	 * Setup how this option should be loaded. This setting not effects immediately. You need call $this->updateValue()
	 * or $this->flush() to persist changes.
	 *
	 * @param $autoload bool True for autoload, false for disable autoload.
	 *
	 * @return $this For chain calls.
	 */
	public function setAutoload($autoload);
}
