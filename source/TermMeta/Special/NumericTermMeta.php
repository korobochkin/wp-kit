<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\TermMeta\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\Numeric\NumericBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\Numeric\NumericConstructorTrait;
use Korobochkin\WPKit\TermMeta\AbstractTermMeta;

/**
 * Class NumericTermMeta
 * @package Korobochkin\WPKit\TermMeta\Special
 */
class NumericTermMeta extends AbstractTermMeta
{
    use NumericConstructorTrait;

    use NumericBuildConstraintTrait;
}
