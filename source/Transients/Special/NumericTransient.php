<?php
namespace Korobochkin\WPKit\Transients\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\Numeric\NumericBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\Numeric\NumericConstructorTrait;
use Korobochkin\WPKit\Transients\AbstractTransient;

class NumericTransient extends AbstractTransient {

	use NumericConstructorTrait;

	use NumericBuildConstraintTrait;
}
