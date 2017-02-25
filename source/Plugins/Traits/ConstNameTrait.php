<?php
namespace Korobochkin\WPKit\Plugins\Traits;

trait ConstNameTrait {

	public function getName() {
		return constant(array(__CLASS__, 'NAME'));
	}
}
