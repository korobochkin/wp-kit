<?php
namespace Korobochkin\WPKit\Tests\DataComponents\Traits\Special\Numeric;

use Korobochkin\WPKit\DataComponents\Traits\Special\Numeric\NumericBuildConstraintTrait;
use Symfony\Component\Validator\Constraints;

class NumericBuildConstraintTraitTest extends \WP_UnitTestCase
{
    public function testBuildConstraint()
    {
        /**
         * @var $stub NumericBuildConstraintTrait
         */
        $stub = $this->getMockForTrait(NumericBuildConstraintTrait::class);

        $this->assertEquals(
            array(
                new Constraints\NotBlank(),
                new Constraints\Type(
                    array(
                        'type' => 'float',
                    )
                ),
            ),
            $stub->buildConstraint()
        );
    }
}
