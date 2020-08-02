<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Common\DataComponents\Special;

use Korobochkin\WPKit\DataComponents\NodeInterface;
use Korobochkin\WPKit\Tests\DataSets\Numeric\NumericTransformationSet;

abstract class AbstractNumericDataComponentTest extends \WP_UnitTestCase
{
    /**
     * @var NodeInterface
     */
    protected $stub;

    /**
     * Prepare option for tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->createAndConfigureStub();
    }

    /**
     * @return NodeInterface
     */
    abstract protected function createAndConfigureStub();

    /**
     * @dataProvider casesTypesAfterSaving
     *
     * @var $value    mixed Value to insert and test.
     * @var $expected mixed Value to compare output value with.
     */
    public function testTypesAfterSaving($value, $expected)
    {
        $this->stub->set($value);

        if (is_string($expected) && class_exists($expected)) {
            $this->expectException($expected);
            $this->stub->flush();
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
        if (is_null($value)) {
            // Default value (null is not caught via $this->hasLocalValue())
            $this->assertSame(0.0, $this->stub->get());
        } else {
            $this->assertSame($value, $this->stub->get());
        }
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
