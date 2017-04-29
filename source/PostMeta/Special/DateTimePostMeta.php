<?php
namespace Korobochkin\WPKit\PostMeta\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\DateTime\DateTimeBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\DateTime\DateTimeConstructorTrait;
use Korobochkin\WPKit\PostMeta\AbstractPostMeta;

class DateTimePostMeta extends AbstractPostMeta {

	use DateTimeConstructorTrait;

	use DateTimeBuildConstraintTrait;
}
