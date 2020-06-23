<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits\Special\DateTime;

use Korobochkin\WPKit\DataComponents\NodeInterface;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;

/**
 * Trait DateTimeConstructorTrait
 * @package Korobochkin\WPKit\DataComponents\Traits\Special\DateTime
 */
trait DateTimeConstructorTrait
{
    public function __construct()
    {
        /**
         * @var $this NodeInterface
         */
        $this->setDataTransformer(new DateTimeToStringTransformer());
    }
}
