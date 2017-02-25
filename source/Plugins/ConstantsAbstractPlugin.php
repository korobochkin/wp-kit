<?php
namespace Korobochkin\WPKit\Plugins;

use Korobochkin\WPKit;

abstract class ConstantsAbstractPlugin extends AbstractPlugin {

	use WPKit\Traits\ConstVersionTrait;

	use WPKit\Traits\ConstNameTrait;
}
