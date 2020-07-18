<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Common\DataComponents\Special;

use Korobochkin\WPKit\DataComponents\NodeInterface;
use Korobochkin\WPKit\Tests\DataSets\Bool\BoolTransformationSet;

abstract class AbstractBoolDataComponentTest extends \WP_UnitTestCase
{
    /**
     * @var NodeInterface
     */
    protected $stub;

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

        if (is_string($expected) && class_exists($expected)) {
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
