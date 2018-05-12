<?php
namespace Korobochkin\WPKit\Tests\TermMeta\Special;

use Korobochkin\WPKit\TermMeta\Special\BoolTermMeta;
use Korobochkin\WPKit\Tests\DataSets\Bool\BoolTransformationSet;
use Korobochkin\WPKit\Utils\WordPressFeatures;

/**
 * Class BoolTermMetaTest
 * @package Korobochkin\WPKit\Tests\TermMeta\Special
 *
 * @group data-components
 */
class BoolTermMetaTest extends \WP_UnitTestCase
{
    /**
     * @var BoolTermMeta
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
        parent::setUp();

        $result = wp_insert_term('Test Term with PHP Unit', 'category', array(
            'description' => 'Description for Test Term',
            'slug' => 'test-term-with-php-unit',
        ));

        $this->termId = $result['term_id'];

        $this->stub = new BoolTermMeta();
        $this->stub->setName('wp_kit_bool_term_meta');
        $this->stub->setTermId($this->termId);
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
