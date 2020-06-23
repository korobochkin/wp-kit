<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Transients\Special;

use Korobochkin\WPKit\DataComponents\AggregateNodeInterface;
use Korobochkin\WPKit\DataComponents\Traits\Aggregate\AggregateGetTrait;
use Korobochkin\WPKit\Transients\AbstractTransient;

/**
 * Class AbstractAggregateTransient
 */
abstract class AbstractAggregateTransient extends AbstractTransient implements AggregateNodeInterface
{
    use AggregateGetTrait;
}
