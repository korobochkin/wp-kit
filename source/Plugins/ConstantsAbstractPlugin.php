<?php
namespace Korobochkin\WPKit\Plugins;

use Korobochkin\WPKit\Traits;

abstract class ConstantsAbstractPlugin extends AbstractPlugin {

	use Traits\ConstVersionTrait;

	use Traits\ConstNameTrait;
}
