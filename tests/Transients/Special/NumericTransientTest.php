<?php
namespace Korobochkin\WPKit\Tests\Transients\Special;

use Korobochkin\WPKit\Tests\DataSets\Numeric\NumericTransformationSet;
use Korobochkin\WPKit\Transients\Special\NumericTransient;

/**
 * Class NumericTransientTest
 * @package Korobochkin\WPKit\Tests\Transients\Special
 *
 * @group data-components
 */
class NumericTransientTest extends \WP_UnitTestCase
{
    /**
     * @var NumericTransient
     */
    protected $stub;

    /**
     * Prepare option for tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->stub = new NumericTransient();
        $this->stub->setName('wp_kit_numeric_transient');
    }

    /**
     * @dataProvider casesTypesAfterSaving
     *
     * @var $value    mixed Value to insert and test.
     * @var $expected mixed Value to compare output value with.
     */
    public function testTypesAfterSaving($value, $expected)
    {
        $this->stub
            ->set($value);

        if (class_exists($expected)) {
            if (PHP_VERSION_ID >= 70000) {
                $this->expectException($expected);
                $this->stub->flush();
            } else {
                try {
                    $this->stub->flush();
                } catch (\Exception $exception) {
                    $this->assertInstanceOf($expected, $exception);
                } finally {
                    $this->assertInstanceOf($expected, $exception);
                }
            }
        } else {
            $this->stub->flush();
            $this->assertSame($expected, $this->stub->get());
        }
    }

    public function casesTypesAfterSaving()
    {
        return new NumericTransformationSet();
    }

    /**
     * @dataProvider casesTypesWithoutSaving
     *
     * @var $value    mixed Value to insert and test.
     * @var $expected mixed Value to compare output value with.
     */
    public function testTypesWithoutSaving($value, $expected)
    {
        $this->stub->set($value);
        $this->assertSame($value, $this->stub->get());
    }

    public function casesTypesWithoutSaving()
    {
        return new NumericTransformationSet();
    }

    public function testDefaultValue()
    {
        $this->assertSame(0.0, $this->stub->get());
    }
}
