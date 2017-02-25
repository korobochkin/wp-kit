<?php
namespace Korobochkin\WPKit\Plugins\Traits;

trait ConstVersionTrait {

	public function getVersion() {
		return constant(array(__CLASS__, 'VERSION'));
	}
}
