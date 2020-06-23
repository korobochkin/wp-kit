<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits\Special\Numeric;

use Korobochkin\WPKit\DataComponents\NodeInterface;
use Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer;

/**
 * Trait NumericConstructorTrait
 * @package Korobochkin\WPKit\DataComponents\Traits\Special\Numeric
 */
trait NumericConstructorTrait
{
    public function __construct()
    {
        /**
         * @var $this NodeInterface
         */
        $this->setDataTransformer(new NumberToLocalizedStringTransformer(10));
        $this->setDefaultValue(0.0);
    }
}
