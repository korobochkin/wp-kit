<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits\Special\Bool;

use Korobochkin\WPKit\DataComponents\NodeInterface;
use Korobochkin\WPKit\DataTransformers\BooleanToStringTransformer;

/**
 * Trait BoolConstructorTrait
 * @package Korobochkin\WPKit\DataComponents\Traits\Special\Bool
 */
trait BoolConstructorTrait
{
    /**
     * BoolOption constructor.
     */
    public function __construct()
    {
        /**
         * @var $this NodeInterface
         */
        $this->setDataTransformer(new BooleanToStringTransformer('1', '0'));
        $this->setDefaultValue(true);
    }
}
