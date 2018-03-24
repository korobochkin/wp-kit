<?php
namespace Korobochkin\WPKit\DataComponents\Traits\Special\Integer;

use Korobochkin\WPKit\DataComponents\NodeInterface;
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
        $this->setDataTransformer(new NumberToLocalizedStringTransformer(0, false));
        $this->setDefaultValue(0);
    }
}
