<?php
namespace Korobochkin\WPKit\Options\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\DateTime\DateTimeBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\DateTime\DateTimeConstructorTrait;
use Korobochkin\WPKit\Options\AbstractOption;

class DateTimeOption extends AbstractOption {

	use DateTimeConstructorTrait;

	use DateTimeBuildConstraintTrait;
}
