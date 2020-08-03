<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\DataComponents\Traits\Special\DateTime;

use Korobochkin\WPKit\DataComponents\Traits\Special\DateTime\DateTimeBuildConstraintTrait;
use Symfony\Component\Validator\Constraints;

class DateTimeBuildConstraintTraitTest extends \WP_UnitTestCase
{
    public function testBuildConstraint()
    {
        /**
         * @var $stub DateTimeBuildConstraintTrait
         */
        $stub = $this->getMockForTrait(DateTimeBuildConstraintTrait::class);

        $this->assertEquals(
            array(
                new Constraints\NotBlank(),
                new Constraints\DateTime(),
            ),
            $stub->buildConstraint()
        );
    }
}
