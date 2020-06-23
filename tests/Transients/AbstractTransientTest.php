<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Transients;

use Korobochkin\WPKit\Tests\DataSets\EverythingSet2;
use Korobochkin\WPKit\Transients\Transient;

/**
 * Class AbstractTransientTest
 * @package Korobochkin\WPKit\Tests\Transients
 *
 * @group data-components
 */
class AbstractTransientTest extends \WP_UnitTestCase
{
    /**
     * @var Transient
     */
    protected $stub;

    /**
     * Prepare option for tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForAbstractClass(Transient::class);
    }

    public function testGetValueFromWordPressWithoutName()
    {
        $this->setExpectedException(
            \LogicException::class,
            'You must specify the name of transient before calling any methods using name of transient.'
        );
        $this->stub->getValueFromWordPress();
    }

    public function testGetValueFromWordPress()
    {
        $this->stub->setName('wp_kit_abstract_transient');
        $this->assertFalse($this->stub->getValueFromWordPress());
    }

    public function testDeleteWithNoSavedValue()
    {
        $this->assertFalse($this->stub->setName('wp_kit_abstract_transient')->delete());
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
        $this->stub->setName('wp_kit_abstract_transient')->updateValue($value);
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
            'You must specify the name of transient before calling any methods using name of transient.'
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
        $this->stub->setName('wp_kit_abstract_transient')->updateValue($value);

        $this->assertSame($deleteResult, $this->stub->deleteFromWP());
        $this->assertFalse($this->stub->getValueFromWordPress());
    }

    public function casesDeleteFromWP()
    {
        return new EverythingSet2(false, true);
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
            'You must specify the name of transient before calling any methods using name of transient.'
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

        $this->stub
            ->setName('wp_kit_abstract_transient')
            ->flush();

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

    public function casesFlush()
    {
        return new EverythingSet2(false, true);
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
            ->setName('wp_kit_abstract_transient');

        $this->assertSame($saveResult, $this->stub->updateValue($value));
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
        return new EverythingSet2(false, true);
    }

    public function testUpdateValueWithExpiration()
    {
        $this->stub->setName('wp_kit_abstract_transient');

        $expiration = HOUR_IN_SECONDS;
        $this->stub->updateValue('1', $expiration);
        $this->assertSame($expiration, $this->stub->getExpiration());

        $expiration = DAY_IN_SECONDS;
        $this->stub->updateValue('2', $expiration);
        $this->assertSame($expiration, $this->stub->getExpiration());
    }

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
        $this->stub->setName('wp_kit_abstract_transient');

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
        return new EverythingSet2(false, true);
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
        $this->stub->setName('wp_kit_abstract_option');

        $this->assertSame($this->stub, $this->stub->set($value));
        $this->assertSame($value, $this->stub->get());
        $this->assertSame($value, $this->stub->getLocalValue());
    }

    public function casesSet()
    {
        return new EverythingSet2(false, true);
    }

    public function testName()
    {
        $this->assertNull($this->stub->getName());

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
        return new EverythingSet2(false, true);
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
        return new EverythingSet2(false, true);
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
        return new EverythingSet2(false, true);
    }

    public function testGetterAndSetterExpiration()
    {
        $this->assertSame(1, $this->stub->getExpiration());
        $this->assertSame($this->stub, $this->stub->setExpiration(123));
        $this->assertSame(123, $this->stub->getExpiration());
    }
}
