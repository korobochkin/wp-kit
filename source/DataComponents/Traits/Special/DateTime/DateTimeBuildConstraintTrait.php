<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits\Special\DateTime;

use Symfony\Component\Validator\Constraints;

/**
 * Trait DateTimeBuildConstraintTrait
 * @package Korobochkin\WPKit\DataComponents\Traits\Special\DateTime
 */
trait DateTimeBuildConstraintTrait
{
    public function buildConstraint()
    {
        return array(
            new Constraints\NotBlank(),
            new Constraints\DateTime(),
        );
    }
}
