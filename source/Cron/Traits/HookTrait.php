<?php
namespace Korobochkin\WPKit\Cron\Traits;

trait HookTrait {

	protected $hook = 'execute';

	/**
	 * Returns the hook (function) which WordPress will call.
	 *
	 * @return callable The hook that WordPress will call.
	 */
	public function getHook() {
		return $this->hook;
	}

	/**
	 * Sets the hook (function) which WordPress will call.
	 *
	 * @param $hook callable The hook that WordPress will call.
	 *
	 * @return $this For chain calls.
	 */
	public function setHook($hook) {
		$this->hook = $hook;
		return $this;
	}
}
