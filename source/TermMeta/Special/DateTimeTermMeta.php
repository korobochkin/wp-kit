<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\TermMeta\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\DateTime\DateTimeBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\DateTime\DateTimeConstructorTrait;
use Korobochkin\WPKit\TermMeta\AbstractTermMeta;

/**
 * Class DateTimeTermMeta
 * @package Korobochkin\WPKit\TermMeta\Special
 */
class DateTimeTermMeta extends AbstractTermMeta
{
    use DateTimeConstructorTrait;

    use DateTimeBuildConstraintTrait;
}
