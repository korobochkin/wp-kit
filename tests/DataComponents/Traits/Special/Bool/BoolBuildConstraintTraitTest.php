<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\DataComponents\Traits\Special\Bool;

use Korobochkin\WPKit\DataComponents\Traits\Special\Bool\BoolBuildConstraintTrait;
use Symfony\Component\Validator\Constraints;

class BoolBuildConstraintTraitTest extends \WP_UnitTestCase
{
    public function testBuildConstraint()
    {
        /**
         * @var $stub BoolBuildConstraintTrait
         */
        $stub = $this->getMockForTrait(BoolBuildConstraintTrait::class);
        $this->assertEquals(
            array(
                new Constraints\NotNull(),
                new Constraints\Type(
                    array(
                        'type' => 'bool',
                    )
                ),
            ),
            $stub->buildConstraint()
        );
    }
}
