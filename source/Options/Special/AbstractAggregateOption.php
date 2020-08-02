<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Options\Special;

use Korobochkin\WPKit\DataComponents\AggregateNodeInterface;
use Korobochkin\WPKit\DataComponents\Traits\Aggregate\AggregateGetTrait;
use Korobochkin\WPKit\Options\AbstractOption;

/**
 * Class AbstractAggregateOption
 */
abstract class AbstractAggregateOption extends AbstractOption implements AggregateNodeInterface
{
    use AggregateGetTrait;
}
