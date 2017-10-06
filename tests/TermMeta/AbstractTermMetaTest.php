<?php
namespace Korobochkin\WPKit\Tests\TermMeta;

use Korobochkin\WPKit\TermMeta\AbstractTermMeta;
use Korobochkin\WPKit\Tests\DataSets\DifferentTypesSet;
use Korobochkin\WPKit\Tests\DataSets\EverythingSet;
use Korobochkin\WPKit\Tests\DataSets\ValidateSet;
use Symfony\Component\Form\Extension\Core\DataTransformer\BooleanToStringTransformer;
use Symfony\Component\Form\ReversedTransformer;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Validation;

/**
 * Class AbstractTermMetaTest
 * @package Korobochkin\WPKit\Tests\TermMeta
 *
 * @group data-components
 */
class AbstractTermMetaTest extends \WP_UnitTestCase
{
    /**
     * @var AbstractTermMeta
     */
    protected $stub;

    /**
     * @var int Term ID.
     */
    protected $termId;

    public function setUp()
    {
        parent::setUp();
        $this->stub   = $this->getMockForAbstractClass(AbstractTermMeta::class);
        $result       = wp_insert_term('Test Term with PHP Unit', 'category', array(
            'description' => 'Description for Test Term',
            'slug' => 'test-term-with-php-unit',
        ));
        $this->termId = $result['term_id'];
    }

    /**
     * Test getting raw value from WordPress
     */
    public function testGetValueFromWordPress()
    {
        if (PHP_VERSION_ID >= 70000) {
            // PHP 7
            $this->expectException(\LogicException::class);
            $this->stub->getValueFromWordPress();
        } else {
            // PHP 5
            try {
                $this->stub->getValueFromWordPress();
            } catch (\Exception $exception) {
                $this->assertTrue(is_a($exception, \LogicException::class));
            }
        }

        $this->stub->setName('wp_kit_abstract_term_meta');
        $this->stub->setTermId($this->termId);
        $this->assertFalse($this->stub->getValueFromWordPress());
    }

    /**
     * Test deleting value in WordPress.
     *
     * @dataProvider casesDeleteFromWP
     *
     * @param $value                            mixed Any variable types.
     * @param $expectedResultOfSavingOrDeletion bool  Result of deleting operation.
     * @param $expectedValueFromWP              mixed Value after saving which will return WP
     */
    public function testDeleteFromWP($value, $expectedResultOfSavingOrDeletion, $expectedValueFromWP)
    {
        // Without name throwing an error.
        if (PHP_VERSION_ID >= 70000) {
            // PHP 7.
            $this->expectException(\LogicException::class);
            $this->stub->deleteFromWP();
        } else {
            // PHP 5.
            try {
                $this->stub->deleteFromWP();
            } catch (\Exception $exception) {
                $this->assertTrue(is_a($exception, \LogicException::class));
            }
        }

        // Load value into WordPress.
        $this->stub
            ->setName('wp_kit_abstract_term_meta')
            ->setTermId($this->termId)
            ->updateValue($value);

        // Check that successful remove from DB.
        $this->assertEquals($expectedResultOfSavingOrDeletion, $this->stub->deleteFromWP());
        $this->assertFalse($this->stub->getValueFromWordPress());
    }

    public function casesDeleteFromWP()
    {
        return new EverythingSet();
    }

    /**
     * Test flushing (saving) values into WordPress with flush().
     *
     * @dataProvider casesFlush
     *
     * @param $value                            mixed Any variable types.
     * @param $expectedResultOfSavingOrDeletion bool  Result of deleting operation.
     * @param $expectedValueFromWP              mixed Value after saving which will return WP
     */
    public function testFlush($value, $expectedResultOfSavingOrDeletion, $expectedValueFromWP)
    {
        $this->stub->set($value);

        if (PHP_VERSION_ID >= 70000) {
            // PHP 7.
            $this->expectException(\LogicException::class);
            $this->stub->flush();
        } else {
            // PHP 5.
            try {
                $this->stub->flush();
            } catch (\Exception $exception) {
                $this->assertTrue(is_a($exception, \LogicException::class));
            }
        }

        $this->stub->setName('wp_kit_abstract_term_meta');
        $this->stub->setTermId($this->termId);

        // Successful saved.
        $this->assertEquals($expectedResultOfSavingOrDeletion, $this->stub->flush());

        // Retrieve value back.
        $this->assertEquals($expectedValueFromWP, $this->stub->get());

        // Local value deleted.
        $this->assertEquals(null, $this->stub->getLocalValue());
    }

    public function casesFlush()
    {
        return new EverythingSet();
    }

    /**
     * Testing flushing (saving) values into WordPress with updateValue().
     *
     * @dataProvider casesUpdateValue
     *
     * @param $value                            mixed Any variable types.
     * @param $expectedResultOfSavingOrDeletion bool  Result of deleting operation.
     * @param $expectedValueFromWP              mixed Value after saving which will return WP
     */
    public function testUpdateValue($value, $expectedResultOfSavingOrDeletion, $expectedValueFromWP)
    {
        $this->stub
            ->setName('wp_kit_abstract_term_meta')
            ->setTermId($this->termId)
            ->set($value);

        // Successful saved.
        $this->assertEquals($expectedResultOfSavingOrDeletion, $this->stub->flush());

        // Retrieve value back.
        $this->assertEquals($expectedValueFromWP, $this->stub->get());

        // Local value deleted.
        $this->assertEquals(null, $this->stub->getLocalValue());
    }

    public function casesUpdateValue()
    {
        return new EverythingSet();
    }

    /* The tests bellow for methods inherited from AbstractNode class */

    /**
     * Testing get() method.
     *
     * @dataProvider casesGet
     *
     * @param $value                            mixed Any variable types.
     * @param $expectedResultOfSavingOrDeletion bool  Result of deleting operation.
     * @param $expectedValueFromWP              mixed Value after saving which will return WP
     */
    public function testGet($value, $expectedResultOfSavingOrDeletion, $expectedValueFromWP)
    {
        // Set name to prevent triggering exceptions.
        $this->stub->setName('wp_kit_abstract_term_meta');

        $this->stub->setTermId($this->termId);

        // Test that local value returned.
        $this->stub->setLocalValue($value);
        $this->assertEquals($value, $this->stub->get());

        // Reset local value.
        $this->stub->setLocalValue(null);

        $this->stub->setName('wp_kit_abstract_term_meta');

        // Check default value.
        $this->assertEquals(null, $this->stub->get());

        // Check Default value again.
        $this->stub->setDefaultValue($value);
        $this->assertEquals($value, $this->stub->get());

        // Check returning local value.
        $this->stub->setDefaultValue(uniqid('wp_kit', true));
        $this->stub->setLocalValue($value);
        if ($value === null) {
            $this->assertEquals($this->stub->getDefaultValue(), $this->stub->get());
        } else {
            $this->assertEquals($value, $this->stub->get());
        }

        // Check value from WordPress after saving.
        $this->stub->flush();
        $this->assertEquals($expectedValueFromWP, $this->stub->get());
    }

    public function casesGet()
    {
        return new EverythingSet();
    }

    /**
     * Testing set() method.
     *
     * @dataProvider casesSet
     *
     * @param $value                            mixed Any variable types.
     * @param $expectedResultOfSavingOrDeletion bool  Result of deleting operation.
     * @param $expectedValueFromWP              mixed Value after saving which will return WP
     */
    public function testSet($value, $expectedResultOfSavingOrDeletion, $expectedValueFromWP)
    {
        // Set name to prevent triggering exceptions.
        $this->stub->setName('wp_kit_abstract_term_meta');
        $this->stub->setTermId($this->termId);

        $this->assertEquals($this->stub, $this->stub->set($value));
        $this->assertEquals($value, $this->stub->get());
        $this->assertEquals($value, $this->stub->getLocalValue());
    }

    public function casesSet()
    {
        return new EverythingSet();
    }

    public function testName()
    {
        $this->assertEquals('_', $this->stub->getName());

        $this->assertEquals($this->stub, $this->stub->setName('wp_kit_dummy_name'));
        $this->assertEquals('_wp_kit_dummy_name', $this->stub->getName());
    }

    /**
     * Testing setLocalValue() and getLocalValue() methods.
     *
     * @dataProvider casesLocalValue
     *
     * @param $value                            mixed Any variable types.
     * @param $expectedResultOfSavingOrDeletion bool  Result of deleting operation.
     * @param $expectedValueFromWP              mixed Value after saving which will return WP
     */
    public function testLocalValue($value, $expectedResultOfSavingOrDeletion, $expectedValueFromWP)
    {
        $this->assertNull($this->stub->getLocalValue());
        $this->assertEquals($this->stub, $this->stub->setLocalValue($value));
        $this->assertEquals($value, $this->stub->getLocalValue());
    }

    public function casesLocalValue()
    {
        return new EverythingSet();
    }

    /**
     * Testing Getter and Setter for default value.
     *
     * @dataProvider casesDefaultValue
     *
     * @param $value mixed Any variable types.
     */
    public function testDefaultValue($value)
    {
        $this->assertNull($this->stub->getDefaultValue());
        $this->assertEquals($this->stub, $this->stub->setDefaultValue($value));
        $this->assertEquals($value, $this->stub->getDefaultValue());
    }

    public function casesDefaultValue()
    {
        return new DifferentTypesSet();
    }

    /**
     * Test deleting local value.
     *
     * @dataProvider casesDeleteLocalValue
     *
     * @param $value mixed Any variable types.
     */
    public function testDeleteLocalValue($value)
    {
        $this->assertEquals($this->stub, $this->stub->setLocalValue($value));
        $this->assertTrue($this->stub->deleteLocal());
        $this->assertNull($this->stub->getLocalValue());
    }

    public function casesDeleteLocalValue()
    {
        return new DifferentTypesSet();
    }

    /**
     * Test Getter and Setter for Constraint
     *
     * @dataProvider casesConstraint
     *
     * @param $value \Symfony\Component\Validator\Constraint[]|\Symfony\Component\Validator\Constraint
     */
    public function testConstraint($value)
    {
        $this->assertNull($this->stub->getConstraint());
        $this->assertEquals($this->stub, $this->stub->setConstraint($value));
        $this->assertEquals($value, $this->stub->getConstraint());
    }

    public function casesConstraint()
    {
        return array(
            array(new Constraints\Blank()),
            array(new Constraints\NotNull()),
            array(
                array(
                    new Constraints\Blank(),
                    new Constraints\NotNull(),
                ),
            ),
        );
    }

    public function testValidator()
    {
        $validator = Validation::createValidator();

        $this->assertNull($this->stub->getValidator());
        $this->assertEquals($this->stub, $this->stub->setValidator($validator));
        $this->assertEquals($validator, $this->stub->getValidator());
    }

    public function testValidate()
    {
        $validator = Validation::createValidator();
        $this->stub->setValidator($validator);
        $this->stub->set('wp_kit_test_value');
        $this->stub->setConstraint(
            array(
                new Constraints\NotNull(),
                new Constraints\EqualTo(
                    array(
                        'value' => 'wp_kit_test_value',
                    )
                ),
            )
        );

        $this->assertInstanceOf(ConstraintViolationList::class, $this->stub->validate());
    }

    /**
     * Testing isValid() method.
     *
     * @dataProvider casesIsValid
     *
     * @param $value mixed Value to set in instance and validate.
     * @param $constraints Constraint|Constraint[] Set of constraints (rules) to validator.
     * @param $expectedValidOrNot bool What should return isValid method.
     */
    public function testIsValid($value, $constraints, $expectedValidOrNot)
    {
        $validator = Validation::createValidator();
        $this->stub->setValidator($validator);

        $this->stub->set($value);
        $this->stub->setConstraint($constraints);
        $this->assertEquals($expectedValidOrNot, $this->stub->isValid());
    }

    public function casesIsValid()
    {
        return new ValidateSet();
    }

    public function testValidateValue()
    {
        $validator = Validation::createValidator();
        $this->stub->setValidator($validator);
        $this->stub->setConstraint(
            array(
                new Constraints\NotNull(),
                new Constraints\EqualTo(
                    array(
                        'value' => 'wp_kit_test_value',
                    )
                ),
            )
        );

        $this->assertInstanceOf(ConstraintViolationList::class, $this->stub->validateValue('wp_kit_test_value'));
    }

    /**
     * Test Getter and Setter for Data Transformers
     *
     * @dataProvider casesTransformer
     *
     * @param $value
     */
    public function testTransformer($value)
    {
        $this->assertEquals($this->stub, $this->stub->setDataTransformer($value));
        $this->assertEquals($value, $this->stub->getDataTransformer());
    }

    public function casesTransformer()
    {
        return array(
            array(new BooleanToStringTransformer('1')),
            array(new ReversedTransformer(new BooleanToStringTransformer('1'))),
        );
    }
}
