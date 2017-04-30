<?php
namespace Korobochkin\WPKit\Transients\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\Bool\BoolBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\Bool\BoolConstructorTrait;
use Korobochkin\WPKit\Transients\AbstractTransient;

class BoolTransient extends AbstractTransient {

	use BoolConstructorTrait;

	use BoolBuildConstraintTrait;
}
