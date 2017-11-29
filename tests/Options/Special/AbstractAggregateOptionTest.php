<?php
namespace Korobochkin\WPKit\Tests\Options\Special;

use Korobochkin\WPKit\Options\Special\AbstractAggregateOption;
use Korobochkin\WPKit\Tests\DataSets\AggregateDataSet;

class AbstractAggregateOptionTest extends \WP_UnitTestCase
{
    /**
     * @var AbstractAggregateOption
     */
    protected $stub;

    /**
     * Prepare option for tests.
     */
    public function setUp()
    {
        parent::setUp();

        $this->stub = $this->getMockForAbstractClass(AbstractAggregateOption::class);
        $this->stub->setName('wp_kit_AbstractAggregateOption');
    }

    /**
     * @dataProvider
     *
     * @param $defaultValue array
     * @param $valueToSave array
     * @param $valueToGet array
     */
    public function testGet($defaultValue, $valueToSave, $valueToGet)
    {
        $this->stub->setDefaultValue($defaultValue);
        $this->assertEquals($defaultValue, $this->stub->get());

        $this->stub->updateValue($valueToSave);
        $this->assertNull($this->stub->getLocalValue());
        $this->assertEquals($valueToSave, $this->stub->getValueFromWordPress());
        $this->assertEquals($valueToGet, $this->stub->get());
    }

    public function casesGet()
    {
        return new AggregateDataSet();
    }
}
