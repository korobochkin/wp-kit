<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\PostMeta\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\Bool\BoolBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\Bool\BoolConstructorTrait;
use Korobochkin\WPKit\PostMeta\AbstractPostMeta;

/**
 * Class BoolPostMeta
 * @package Korobochkin\WPKit\PostMeta\Special
 */
class BoolPostMeta extends AbstractPostMeta
{
    use BoolConstructorTrait;

    use BoolBuildConstraintTrait;
}
