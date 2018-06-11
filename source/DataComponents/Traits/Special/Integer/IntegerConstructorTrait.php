<?php
namespace Korobochkin\WPKit\DataComponents\Traits\Special\Integer;

use Korobochkin\WPKit\DataComponents\NodeInterface;
use Korobochkin\WPKit\DataTransformers\IntegerToStringTransformer;
use Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer;

/**
 * Trait IntegerConstructorTrait
 */
trait IntegerConstructorTrait
{
    public function __construct()
    {
        /**
         * @var $this NodeInterface
         */
        $this->setDataTransformer(new IntegerToStringTransformer());
        $this->setDefaultValue(0);
    }
}
