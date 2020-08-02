<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits\Special\Bool;

use Symfony\Component\Validator\Constraints;

/**
 * Trait BoolBuildConstraintTrait
 * @package Korobochkin\WPKit\DataComponents\Traits\Special\Bool
 */
trait BoolBuildConstraintTrait
{
    public function buildConstraint()
    {
        return array(
            new Constraints\NotNull(),
            new Constraints\Type(
                array(
                    'type' => 'bool',
                )
            ),
        );
    }
}
