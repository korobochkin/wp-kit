<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits\Special\Numeric;

use Symfony\Component\Validator\Constraints;

/**
 * Trait NumericBuildConstraintTrait
 * @package Korobochkin\WPKit\DataComponents\Traits\Special\Numeric
 */
trait NumericBuildConstraintTrait
{

    /**
     * @return array
     */
    public function buildConstraint()
    {
        return array(
            new Constraints\NotBlank(),
            new Constraints\Type(
                array(
                    'type' => 'float',
                )
            ),
        );
    }
}
