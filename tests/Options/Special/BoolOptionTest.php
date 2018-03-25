<?php
namespace Korobochkin\WPKit\Tests\Options\Special;

use Korobochkin\WPKit\Options\Special\BoolOption;
use Korobochkin\WPKit\Tests\DataSets\Bool\BoolTransformationSet;

/**
 * Class BoolOptionTest
 * @package Korobochkin\WPKit\Tests\Options\Special
 *
 * @group data-components
 */
class BoolOptionTest extends \WP_UnitTestCase
{
    /**
     * @var BoolOption
     */
    protected $stub;

    /**
     * Prepare option for tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->stub = new BoolOption();
        $this->stub->setName('wp_kit_bool_option');
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
                    $this->assertTrue(is_a($exception, $expected));
                }
            }
        } else {
            $this->stub->flush();
            $this->assertSame($expected, $this->stub->get());
        }
    }

    public function casesTypesAfterSaving()
    {
        return new BoolTransformationSet();
    }

    /**
     * @dataProvider casesTypesWithoutSaving
     *
     * @var $value mixed Value to insert and test.
     * @var $expected mixed Value to compare output value with.
     */
    public function testTypesWithoutSaving($value, $expected)
    {
        $this->stub->set($value);

        if (class_exists($expected)) {
            $this->assertSame($value, $this->stub->get());
        } else {
            $this->assertSame($expected, $this->stub->get());
        }
    }

    public function casesTypesWithoutSaving()
    {
        return new BoolTransformationSet();
    }

    public function testDefaultValue()
    {
        $this->assertSame(true, $this->stub->get());
    }
}
