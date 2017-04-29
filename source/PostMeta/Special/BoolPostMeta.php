<?php
namespace Korobochkin\WPKit\PostMeta\Special;

use Korobochkin\WPKit\DataComponents\Traits\Special\Bool\BoolBuildConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\Special\Bool\BoolConstructorTrait;
use Korobochkin\WPKit\PostMeta\AbstractPostMeta;

class BoolPostMeta extends AbstractPostMeta {

	use BoolConstructorTrait;

	use BoolBuildConstraintTrait;
}
