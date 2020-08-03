<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Transients\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\DateTime\DateTimeBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\DateTime\DateTimeConstructorTrait;
use Korobochkin\WPKit\Transients\AbstractTransient;

/**
 * Class DateTimeTransient
 * @package Korobochkin\WPKit\Transients\Special
 */
class DateTimeTransient extends AbstractTransient
{
    use DateTimeConstructorTrait;

    use DateTimeBuildConstraintTrait;
}
