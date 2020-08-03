<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Transients\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\Bool\BoolBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\Bool\BoolConstructorTrait;
use Korobochkin\WPKit\Transients\AbstractTransient;

/**
 * Class BoolTransient
 * @package Korobochkin\WPKit\Transients\Special
 */
class BoolTransient extends AbstractTransient
{
    use BoolConstructorTrait;

    use BoolBuildConstraintTrait;
}
