<?php
namespace Korobochkin\WPKit\Tests\Options\Special;

use Korobochkin\WPKit\Options\Special\IntegerOption;
use Korobochkin\WPKit\Tests\DataSets\Integer\IntegerTransformationSet;

/**
 * Class IntegerOptionTest
 */
class IntegerOptionTest extends \WP_UnitTestCase
{
    /**
     * @var IntegerOption
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();
        $this->stub = new IntegerOption();
        $this->stub->setName('wp_kit_integer_option');
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

        // In case if we expect Exception from DataTransformer
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
        return new IntegerTransformationSet();
    }

    public function testDefaultValue()
    {
        $this->assertSame(0, $this->stub->get());
    }
}
