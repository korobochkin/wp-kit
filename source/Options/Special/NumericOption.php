<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Options\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\Numeric\NumericBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\Numeric\NumericConstructorTrait;
use Korobochkin\WPKit\Options\AbstractOption;

/**
 * Class NumericOption
 * @package Korobochkin\WPKit\Options\Special
 */
class NumericOption extends AbstractOption
{

    use NumericConstructorTrait;

    use NumericBuildConstraintTrait;
}
