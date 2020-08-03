<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Transients\Special;

use Korobochkin\WPKit\Tests\DataSets\AggregateDataSet;
use Korobochkin\WPKit\Transients\Special\AbstractAggregateTransient;

class AbstractAggregateTransientTest extends \WP_UnitTestCase
{
    /**
     * @var AbstractAggregateTransient
     */
    protected $stub;

    /**
     * Prepare option for tests.
     */
    public function setUp()
    {
        parent::setUp();

        $this->stub = $this->getMockForAbstractClass(AbstractAggregateTransient::class);
        $this->stub->setName('wp_kit_AbstractAggregateTransient');
    }

    /**
     * @dataProvider casesGet
     *
     * @param $defaultValue array
     * @param $valueToSave array
     * @param $valueToGet array
     */
    public function testGet($defaultValue, $valueToSave, $valueToGet)
    {
        $this->stub->setDefaultValue($defaultValue);
        $this->assertSame($defaultValue, $this->stub->get());

        $this->stub->updateValue($valueToSave);
        $this->assertNull($this->stub->getLocalValue());
        $this->assertSame($valueToSave, $this->stub->getValueFromWordPress());
        $this->assertSame($valueToGet, $this->stub->get());
    }

    public function casesGet()
    {
        return new AggregateDataSet();
    }
}
