<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Transients\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\Numeric\NumericBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\Numeric\NumericConstructorTrait;
use Korobochkin\WPKit\Transients\AbstractTransient;

/**
 * Class NumericTransient
 * @package Korobochkin\WPKit\Transients\Special
 */
class NumericTransient extends AbstractTransient
{
    use NumericConstructorTrait;

    use NumericBuildConstraintTrait;
}
