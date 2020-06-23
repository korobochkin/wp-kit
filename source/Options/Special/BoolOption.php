<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Options\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\Bool\BoolBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\Bool\BoolConstructorTrait;
use Korobochkin\WPKit\Options\AbstractOption;

/**
 * Class BoolOption
 * @package Korobochkin\WPKit\Options\Special
 */
class BoolOption extends AbstractOption
{

    use BoolConstructorTrait;

    use BoolBuildConstraintTrait;
}
