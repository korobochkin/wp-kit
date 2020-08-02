<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\PostMeta\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\DateTime\DateTimeBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\DateTime\DateTimeConstructorTrait;
use Korobochkin\WPKit\PostMeta\AbstractPostMeta;

/**
 * Class DateTimePostMeta
 * @package Korobochkin\WPKit\PostMeta\Special
 */
class DateTimePostMeta extends AbstractPostMeta
{
    use DateTimeConstructorTrait;

    use DateTimeBuildConstraintTrait;
}
