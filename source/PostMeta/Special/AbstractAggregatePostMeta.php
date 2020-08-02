<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\PostMeta\Special;

use Korobochkin\WPKit\DataComponents\AggregateNodeInterface;
use Korobochkin\WPKit\DataComponents\Traits\Aggregate\AggregateGetTrait;
use Korobochkin\WPKit\PostMeta\AbstractPostMeta;

/**
 * Class AbstractAggregatePostMeta
 */
abstract class AbstractAggregatePostMeta extends AbstractPostMeta implements AggregateNodeInterface
{
    use AggregateGetTrait;
}
