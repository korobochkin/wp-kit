<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Common\DataComponents\Special;

use Korobochkin\WPKit\DataComponents\NodeInterface;
use Korobochkin\WPKit\Tests\DataSets\DateTime\DateTimeTransformationSet;

abstract class AbstractDateTimeDataComponentTest extends \WP_UnitTestCase
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
     * @dataProvider casesTypes
     * @var $value mixed Value to insert and test.
     * @var $expected mixed Value to compare output value with.
     */
    public function testTypes($value, $expected)
    {
        $this->stub->set($value);

        if (is_object($expected) && is_a($expected, \DateTime::class)) {
            $this->stub->flush();
            $this->assertSame($expected->format('Y-m-d H:i:s'), $this->stub->get()->format('Y-m-d H:i:s'));
        } else {
            $this->expectException($expected);
            $this->stub->flush();
        }
    }

    public function casesTypes()
    {
        return new DateTimeTransformationSet();
    }

    public function testNull()
    {
        $this->stub->set(null);
        $this->assertNull($this->stub->get());
    }
}
