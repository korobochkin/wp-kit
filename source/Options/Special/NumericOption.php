<?php
namespace Korobochkin\WPKit\Options\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\Numeric\NumericBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\Numeric\NumericConstructorTrait;
use Korobochkin\WPKit\Options\AbstractOption;

class NumericOption extends AbstractOption {

	use NumericConstructorTrait;

	use NumericBuildConstraintTrait;
}
