<?php
namespace Korobochkin\WPKit\DataComponents;

use Korobochkin\WPKit\DataComponents\Traits\AggregateNodeTrait;

/**
 * Class AbstractAggregateNode
 * @package Korobochkin\WPKit\DataComponents
 */
abstract class AbstractAggregateNode extends AbstractNode
{

    use AggregateNodeTrait;
}
