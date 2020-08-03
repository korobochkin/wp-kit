<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents;

use Korobochkin\WPKit\DataComponents\Traits\ConstraintTrait;
use Korobochkin\WPKit\DataComponents\Traits\DataTransformerTrait;
use Korobochkin\WPKit\DataComponents\Traits\DefaultValueTrait;
use Korobochkin\WPKit\DataComponents\Traits\DeleteLocalValueTrait;
use Korobochkin\WPKit\DataComponents\Traits\GetTrait;
use Korobochkin\WPKit\DataComponents\Traits\SetTrait;
use Korobochkin\WPKit\DataComponents\Traits\LocalValueTrait;
use Korobochkin\WPKit\DataComponents\Traits\NameTrait;
use Korobochkin\WPKit\DataComponents\Traits\ValidateTrait;
use Korobochkin\WPKit\DataComponents\Traits\ValidatorTrait;

/**
 * Class AbstractNode
 * @package Korobochkin\WPKit\DataComponents
 */
abstract class AbstractNode implements NodeInterface
{

    use GetTrait;

    use SetTrait;

    use NameTrait;

    use LocalValueTrait;

    use DefaultValueTrait;

    use DeleteLocalValueTrait;

    use ConstraintTrait;

    use ValidatorTrait;

    use ValidateTrait;

    use DataTransformerTrait;
}
