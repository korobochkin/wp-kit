<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\TermMeta\Special;

use Korobochkin\WPKit\DataComponents\AggregateNodeInterface;
use Korobochkin\WPKit\DataComponents\Traits\Aggregate\AggregateGetTrait;
use Korobochkin\WPKit\TermMeta\AbstractTermMeta;

/**
 * Class AbstractAggregateTermMeta
 */
abstract class AbstractAggregateTermMeta extends AbstractTermMeta implements AggregateNodeInterface
{
    use AggregateGetTrait;
}
