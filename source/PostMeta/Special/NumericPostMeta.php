<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\PostMeta\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\Numeric\NumericBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\Numeric\NumericConstructorTrait;
use Korobochkin\WPKit\PostMeta\AbstractPostMeta;

/**
 * Class NumericPostMeta
 * @package Korobochkin\WPKit\PostMeta\Special
 */
class NumericPostMeta extends AbstractPostMeta
{
    use NumericConstructorTrait;

    use NumericBuildConstraintTrait;
}
