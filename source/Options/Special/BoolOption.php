<?php
namespace Korobochkin\WPKit\Options\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\Bool\BoolBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\Bool\BoolConstructorTrait;
use Korobochkin\WPKit\Options\AbstractOption;

class BoolOption extends AbstractOption {

	use BoolConstructorTrait;

	use BoolBuildConstraintTrait;
}
