<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\TermMeta\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\Bool\BoolBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\Bool\BoolConstructorTrait;
use Korobochkin\WPKit\TermMeta\AbstractTermMeta;

/**
 * Class BoolTermMeta
 * @package Korobochkin\WPKit\TermMeta\Special
 */
class BoolTermMeta extends AbstractTermMeta
{
    use BoolConstructorTrait;

    use BoolBuildConstraintTrait;
}
