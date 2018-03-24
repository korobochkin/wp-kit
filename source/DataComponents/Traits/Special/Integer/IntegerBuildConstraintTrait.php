<?php
namespace Korobochkin\WPKit\DataComponents\Traits\Special\Integer;

use Symfony\Component\Validator\Constraints;

/**
 * Trait IntegerBuildConstraintTrait
 */
trait IntegerBuildConstraintTrait
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
                    'type' => 'int',
                )
            ),
        );
    }
}
