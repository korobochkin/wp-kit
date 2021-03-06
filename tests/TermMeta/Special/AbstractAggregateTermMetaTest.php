<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\TermMeta\Special;

use Korobochkin\WPKit\TermMeta\Special\AbstractAggregateTermMeta;
use Korobochkin\WPKit\Tests\DataSets\AggregateDataSet;
use Korobochkin\WPKit\Utils\Compatibility;
use Korobochkin\WPKit\Utils\WordPressFeatures;

class AbstractAggregateTermMetaTest extends \WP_UnitTestCase
{
    /**
     * @var AbstractAggregateTermMeta
     */
    protected $stub;

    /**
     * @var int Term ID for accessing post meta.
     */
    protected $termId;

    /**
     * Prepare option for tests.
     */
    public function setUp()
    {
        if (!WordPressFeatures::isTermsMetaSupported()) {
            // Skip tests on WP bellow 4.4 since it doesn't have required functions.
            $this->markTestSkipped('Term meta features not supported in WordPress bellow 4.4');
        }

        if (!Compatibility::checkWordPress('5.3') && PHP_VERSION_ID >= 70400) {
            // WP <5.3 && PHP >= 7.4
            $this->markTestSkipped('https://core.trac.wordpress.org/ticket/47783');
        }

        parent::setUp();

        $result = wp_insert_term('Test Term with PHP Unit', 'category', array(
            'description' => 'Description for Test Term',
            'slug' => 'test-term-with-php-unit',
        ));

        $this->termId = $result['term_id'];

        $this->stub = $this->getMockForAbstractClass(AbstractAggregateTermMeta::class);
        $this->stub
            ->setName('wp_kit_AbstractAggregateTermMeta')
            ->setTermId($this->termId);
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
