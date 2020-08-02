<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\TermMeta;

use Korobochkin\WPKit\TermMeta\AbstractTermMeta;
use Korobochkin\WPKit\Tests\DataSets\EverythingSet2;
use Korobochkin\WPKit\Tests\DataSets\ValidateSet;
use Korobochkin\WPKit\Utils\WordPressFeatures;
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
        if (!WordPressFeatures::isTermsMetaSupported()) {
            // Skip tests on WP bellow 4.4 since it doesn't have required functions.
            $this->markTestSkipped('Term meta features not supported in WordPress bellow 4.4');
        }

        parent::setUp();
        $this->stub   = $this->getMockForAbstractClass(AbstractTermMeta::class);
        $result       = wp_insert_term('Test Term with PHP Unit', 'category', array(
            'description' => 'Description for Test Term',
            'slug' => 'test-term-with-php-unit',
        ));
        $this->termId = $result['term_id'];
    }

    public function testGetValueFromWordPressWithoutName()
    {
        $this->setExpectedException(
            \LogicException::class,
            'You must specify the name of term meta before calling any methods using name of term meta.'
        );
        $this->stub->getValueFromWordPress();
    }

    public function testGetValueFromWordPressWithoutTermId()
    {
        $this->stub->setName('wp_kit_abstract_option');
        $this->setExpectedException(
            \LogicException::class,
            'You must specify the ID of term before calling any methods using ID of term.'
        );
        $this->stub->getValueFromWordPress();
    }

    public function testGetValueFromWordPress()
    {
        $this->stub
            ->setName('wp_kit_abstract_term_meta')
            ->setTermId($this->termId);
        $this->assertFalse($this->stub->getValueFromWordPress());
    }

    public function testDeleteWithNoSavedValue()
    {
        $this->stub->setName('wp_kit_abstract_term_meta')->setTermId($this->termId);
        $this->assertFalse($this->stub->delete());
    }

    /**
     * @dataProvider casesDeleteFromWP
     * @param $value mixed Any variable types.
     * @param $saveResult bool Result of saving $value in WordPress.
     * @param $valueResult mixed $value returned by WordPress.
     * @param $deleteResult bool Result of deleting $value in WordPress.
     */
    public function testDeleteWithSavedValue($value, $saveResult, $valueResult, $deleteResult)
    {
        $this->stub
            ->setName('wp_kit_abstract_term_meta')
            ->setTermId($this->termId)
            ->updateValue($value);

        if ($saveResult) {
            $this->assertTrue($this->stub->delete());
            $this->assertNull($this->stub->getLocalValue());
        } else {
            $this->assertFalse($this->stub->delete());
            $this->assertSame($value, $this->stub->getLocalValue());
        }
    }

    public function testDeleteFromWPWithoutName()
    {
        $this->setExpectedException(
            \LogicException::class,
            'You must specify the name of term meta before calling any methods using name of term meta.'
        );
        $this->stub->deleteFromWP();
    }

    public function testDeleteFromWPWithoutPostId()
    {
        $this->stub->setName('wp_kit_abstract_term_meta');
        $this->setExpectedException(
            \LogicException::class,
            'You must specify the ID of term before calling any methods using ID of term.'
        );
        $this->stub->deleteFromWP();
    }

    /**
     * Test deleting value in WordPress.
     *
     * @dataProvider casesDeleteFromWP
     *
     * @param $value mixed Any variable types.
     * @param $saveResult bool Result of saving $value in WordPress.
     * @param $valueResult mixed $value returned by WordPress.
     * @param $deleteResult bool Result of deleting $value in WordPress.
     */
    public function testDeleteFromWP($value, $saveResult, $valueResult, $deleteResult)
    {
        $this->stub
            ->setName('wp_kit_abstract_term_meta')
            ->setTermId($this->termId)
            ->updateValue($value);

        $this->assertSame($deleteResult, $this->stub->deleteFromWP());
        $this->assertFalse($this->stub->getValueFromWordPress());
    }

    public function casesDeleteFromWP()
    {
        return new EverythingSet2(true);
    }

    /**
     * Test flushing (saving) values into WordPress with flush().
     *
     * @dataProvider casesFlush
     *
     * @param $value mixed Any variable types.
     * @param $saveResult bool Result of saving $value in WordPress.
     * @param $valueResult mixed $value returned by WordPress.
     * @param $deleteResult bool Result of deleting $value in WordPress.
     */
    public function testFlushWithoutName($value, $saveResult, $valueResult, $deleteResult)
    {
        $this->stub->set($value);

        $this->setExpectedException(
            \LogicException::class,
            'You must specify the name of term meta before calling any methods using name of term meta.'
        );

        $this->stub->flush();
    }

    /**
     * Test flushing (saving) values into WordPress with flush().
     *
     * @dataProvider casesFlush
     *
     * @param $value mixed Any variable types.
     * @param $saveResult bool Result of saving $value in WordPress.
     * @param $valueResult mixed $value returned by WordPress.
     * @param $deleteResult bool Result of deleting $value in WordPress.
     */
    public function testFlushWithoutPostId($value, $saveResult, $valueResult, $deleteResult)
    {
        $this->stub->set($value)->setName('wp_kit_abstract_term_meta');

        $this->setExpectedException(
            \LogicException::class,
            'You must specify the ID of term before calling any methods using ID of term.'
        );

        $this->stub->flush();
    }

    /**
     * Test flushing (saving) values into WordPress with flush().
     *
     * @dataProvider casesFlush
     *
     * @param $value mixed Any variable types.
     * @param $saveResult bool Result of saving $value in WordPress.
     * @param $valueResult mixed $value returned by WordPress.
     * @param $deleteResult bool Result of deleting $value in WordPress.
     */
    public function testFlush($value, $saveResult, $valueResult, $deleteResult)
    {
        $this->stub->set($value);

        if (null !== $value) {
            $this->assertSame($value, $this->stub->get());
        }

        $this->stub->setName('wp_kit_abstract_term_meta');
        $this->stub->setTermId($this->termId);
        $this->stub->flush();

        if (true === $saveResult) {
            if (is_object($value)) {
                $this->assertEquals($valueResult, $this->stub->getValueFromWordPress());
            } else {
                $this->assertSame($valueResult, $this->stub->getValueFromWordPress());
            }
            $this->assertSame(null, $this->stub->getLocalValue());
        } else {
            $this->assertSame(false, $this->stub->getValueFromWordPress());
            $this->assertSame($value, $this->stub->getLocalValue());
        }
    }

    public function casesFlush()
    {
        return new EverythingSet2(true);
    }

    /**
     * Testing flushing (saving) values into WordPress with updateValue().
     *
     * @dataProvider casesUpdateValue
     *
     * @param $value mixed Any variable types.
     * @param $saveResult bool Result of saving $value in WordPress.
     * @param $valueResult mixed $value returned by WordPress.
     * @param $deleteResult bool Result of deleting $value in WordPress.
     */
    public function testUpdateValue($value, $saveResult, $valueResult, $deleteResult)
    {
        $this->stub
            ->setName('wp_kit_abstract_term_meta')
            ->setTermId($this->termId);


        $updateValueCallReturn = $this->stub->updateValue($value);
        if (is_int($updateValueCallReturn)) {
            $updateValueCallReturn = true;
        }
        $this->assertSame($saveResult, $updateValueCallReturn);
        wp_cache_flush();

        if (true === $saveResult) {
            if (is_object($value)) {
                $this->assertEquals($valueResult, $this->stub->getValueFromWordPress());
            } else {
                $this->assertSame($valueResult, $this->stub->getValueFromWordPress());
            }
            $this->assertSame(null, $this->stub->getLocalValue());
        } else {
            $this->assertSame(false, $this->stub->getValueFromWordPress());
            $this->assertSame($value, $this->stub->getLocalValue());
        }
    }

    public function casesUpdateValue()
    {
        return new EverythingSet2(true);
    }

    /* The tests bellow for methods inherited from AbstractNode class */

    /**
     * Testing get() method.
     *
     * @dataProvider casesGet
     *
     * @param $value mixed Any variable types.
     * @param $saveResult bool Result of saving $value in WordPress.
     * @param $valueResult mixed $value returned by WordPress.
     * @param $deleteResult bool Result of deleting $value in WordPress.
     */
    public function testGet($value, $saveResult, $valueResult, $deleteResult)
    {
        // Set name to prevent triggering exceptions.
        $this->stub->setName('wp_kit_abstract_term_meta');

        $this->stub->setTermId($this->termId);

        // Test that local value returned.
        $this->stub->setLocalValue($value);
        $this->assertSame($value, $this->stub->get());

        // Reset local value.
        $this->stub->setLocalValue(null);

        // Check default value.
        $this->assertSame(null, $this->stub->get());

        // Check Default value again.
        $this->stub->setDefaultValue($value);
        $this->assertSame($value, $this->stub->get());

        // Check returning local value.
        $this->stub->setDefaultValue(uniqid('wp_kit', true));
        $this->stub->setLocalValue($value);
        if ($value === null) {
            $this->assertSame($this->stub->getDefaultValue(), $this->stub->get());
        } else {
            $this->assertSame($value, $this->stub->get());
        }

        // Check value from WordPress after saving.
        $this->stub->flush();
        wp_cache_flush();
        if (true === $saveResult) {
            if (is_object($value)) {
                $this->assertEquals($valueResult, $this->stub->get());
            } else {
                $this->assertSame($valueResult, $this->stub->get());
            }
        } else {
            $this->assertSame($value, $this->stub->get());
            $this->assertSame($value, $this->stub->getLocalValue());
        }
    }

    public function casesGet()
    {
        return new EverythingSet2(true);
    }

    /**
     * Testing set() method.
     *
     * @dataProvider casesSet
     *
     * @param $value mixed Any variable types.
     * @param $saveResult bool Result of saving $value in WordPress.
     * @param $valueResult mixed $value returned by WordPress.
     * @param $deleteResult bool Result of deleting $value in WordPress.
     */
    public function testSet($value, $saveResult, $valueResult, $deleteResult)
    {
        $this->stub->setName('wp_kit_abstract_term_meta');
        $this->stub->setTermId($this->termId);

        $this->assertSame($this->stub, $this->stub->set($value));
        $this->assertSame($value, $this->stub->get());
        $this->assertSame($value, $this->stub->getLocalValue());
    }

    public function casesSet()
    {
        return new EverythingSet2(true);
    }

    public function testName()
    {
        $this->assertSame(null, $this->stub->getName());

        $this->assertSame($this->stub, $this->stub->setName('wp_kit_dummy_name'));
        $this->assertSame('wp_kit_dummy_name', $this->stub->getName());
    }

    /**
     * Testing setLocalValue() and getLocalValue() methods.
     *
     * @dataProvider casesLocalValue
     *
     * @param $value mixed Any variable types.
     * @param $saveResult bool Result of saving $value in WordPress.
     * @param $valueResult mixed $value returned by WordPress.
     * @param $deleteResult bool Result of deleting $value in WordPress.
     */
    public function testLocalValue($value, $saveResult, $valueResult, $deleteResult)
    {
        $this->assertNull($this->stub->getLocalValue());
        $this->assertSame($this->stub, $this->stub->setLocalValue($value));
        $this->assertSame($value, $this->stub->getLocalValue());
    }

    public function casesLocalValue()
    {
        return new EverythingSet2(true);
    }

    /**
     * Testing Getter and Setter for default value.
     *
     * @dataProvider casesDefaultValue
     *
     * @param $value mixed Any variable types.
     * @param $saveResult bool Result of saving $value in WordPress.
     * @param $valueResult mixed $value returned by WordPress.
     * @param $deleteResult bool Result of deleting $value in WordPress.
     */
    public function testDefaultValue($value, $saveResult, $valueResult, $deleteResult)
    {
        $this->assertNull($this->stub->getDefaultValue());
        $this->assertSame($this->stub, $this->stub->setDefaultValue($value));
        $this->assertSame($value, $this->stub->getDefaultValue());
    }

    public function casesDefaultValue()
    {
        return new EverythingSet2(true);
    }

    public function testHasDefaultValueNotSetUp()
    {
        $this->assertFalse($this->stub->hasDefaultValue());
    }

    /**
     * @dataProvider casesDefaultValue
     * @param $value mixed Any variable types.
     * @param $saveResult bool Result of saving $value in WordPress.
     * @param $valueResult mixed $value returned by WordPress.
     * @param $deleteResult bool Result of deleting $value in WordPress.
     */
    public function testHasDefaultValue($value, $saveResult, $valueResult, $deleteResult)
    {
        $this->stub->setDefaultValue($value);
        if (is_null($value)) {
            $this->assertFalse($this->stub->hasDefaultValue());
        } else {
            $this->assertTrue($this->stub->hasDefaultValue());
        }
    }

    /**
     * Test deleting local value.
     *
     * @dataProvider casesDeleteLocalValue
     *
     * @param $value mixed Any variable types.
     * @param $saveResult bool Result of saving $value in WordPress.
     * @param $valueResult mixed $value returned by WordPress.
     * @param $deleteResult bool Result of deleting $value in WordPress.
     */
    public function testDeleteLocalValue($value, $saveResult, $valueResult, $deleteResult)
    {
        $this->assertSame($this->stub, $this->stub->setLocalValue($value));
        $this->assertTrue($this->stub->deleteLocal());
        $this->assertNull($this->stub->getLocalValue());
    }

    public function casesDeleteLocalValue()
    {
        return new EverythingSet2(true);
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
        $this->assertSame($this->stub, $this->stub->setConstraint($value));
        $this->assertSame($value, $this->stub->getConstraint());
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
        $this->assertSame($this->stub, $this->stub->setValidator($validator));
        $this->assertSame($validator, $this->stub->getValidator());
    }

    public function testValidate()
    {
        $validator = Validation::createValidator();
        $this->stub->setValidator($validator);


        // Validate primitive scenario with valid value.

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


        // Validate other type of value. Expected exception.

        $this->stub->setConstraint(
            array(
                new Constraints\Choice(array(
                    'choices' => array(1, 2, 3),
                    'multiple' => true,
                    'strict' => true,
                ))
            )
        );

        $this->setExpectedException(\Exception::class, 'Expected argument of type "array", "string" given');
        $this->stub->validate();
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
        $this->assertSame($expectedValidOrNot, $this->stub->isValid());
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
        $this->assertSame($this->stub, $this->stub->setDataTransformer($value));
        $this->assertSame($value, $this->stub->getDataTransformer());
    }

    public function casesTransformer()
    {
        return array(
            array(new BooleanToStringTransformer('1')),
            array(new ReversedTransformer(new BooleanToStringTransformer('1'))),
        );
    }
}
