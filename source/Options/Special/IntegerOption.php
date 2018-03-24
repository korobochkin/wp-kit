<?php
namespace Korobochkin\WPKit\Options\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\Integer\IntegerBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\Integer\IntegerConstructorTrait;
use Korobochkin\WPKit\Options\AbstractOption;

/**
 * Class IntegerOption
 */
class IntegerOption extends AbstractOption
{
    use IntegerConstructorTrait;

    use IntegerBuildConstraintTrait;
}
