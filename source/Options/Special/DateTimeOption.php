<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Options\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\DateTime\DateTimeBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\DateTime\DateTimeConstructorTrait;
use Korobochkin\WPKit\Options\AbstractOption;

/**
 * Class DateTimeOption
 * @package Korobochkin\WPKit\Options\Special
 */
class DateTimeOption extends AbstractOption
{

    use DateTimeConstructorTrait;

    use DateTimeBuildConstraintTrait;
}
