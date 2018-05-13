<?php
namespace Korobochkin\WPKit\Tests\DataComponents;

use Korobochkin\WPKit\DataComponents\NodeFactory;
use Korobochkin\WPKit\Options\Special\BoolOption;
use Korobochkin\WPKit\PostMeta\Special\BoolPostMeta;
use Korobochkin\WPKit\TermMeta\Special\BoolTermMeta;
use Korobochkin\WPKit\Transients\Special\BoolTransient;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints;

/**
 * Class NodeFactoryTest
 */
class NodeFactoryTest extends \WP_UnitTestCase
{
    public function testConstructor()
    {
        $validator = Validation::createValidator();
        $stub = new NodeFactory($validator);
        $this->assertSame($validator, $stub->getValidator());
    }

    public function testValidatorGetterAndSetter()
    {
        $validator1 = Validation::createValidator();
        $validator2 = Validation::createValidator();

        $stub = new NodeFactory($validator1);

        $this->assertSame($stub, $stub->setValidator($validator2));
        $this->assertSame($validator2, $stub->getValidator());
    }

    public function testCreate()
    {
        $validator = Validation::createValidator();
        $stub = new NodeFactory($validator);

        $constraints = array(
            new Constraints\NotNull(),
            new Constraints\Type(
                array(
                    'type' => 'bool',
                )
            ),
        );

        $boolOption = $stub->create(BoolOption::class);

        $this->assertSame($validator, $boolOption->getValidator());
        $this->assertSame($constraints, $boolOption->getConstraint());

        $boolPostMeta = $stub->create(BoolPostMeta::class);

        $this->assertSame($validator, $boolPostMeta->getValidator());
        $this->assertSame($constraints, $boolPostMeta->getConstraint());

        $boolTermMeta = $stub->create(BoolTermMeta::class);
        $this->assertSame($validator, $boolTermMeta->getValidator());
        $this->assertSame($constraints, $boolTermMeta->getConstraint());

        $boolTransient = $stub->create(BoolTransient::class);
        $this->assertSame($validator, $boolTransient->getValidator());
        $this->assertSame($constraints, $boolTransient->getConstraint());
    }
}
