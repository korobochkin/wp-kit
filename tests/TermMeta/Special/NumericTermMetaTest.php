<?php
namespace Korobochkin\WPKit\Tests\TermMeta\Special;

use Korobochkin\WPKit\TermMeta\Special\NumericTermMeta;
use Korobochkin\WPKit\Tests\DataSets\Numeric\NumericTransformationSet;
use Korobochkin\WPKit\Utils\WordPressFeatures;

/**
 * Class NumericTermMetaTest
 * @package Korobochkin\WPKit\Tests\TermMeta\Special
 *
 * @group data-components
 */
class NumericTermMetaTest extends \WP_UnitTestCase
{

    /**
     * @var NumericTermMeta
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

        $this->termId = wp_insert_post(
            array(
                'post_content' => 'WP Kit demo post.',
                'post_title'   => 'WP Kit demo title',
            )
        );

        $this->stub = new NumericTermMeta();
        $this->stub->setName('wp_kit_numeric_term_meta');
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
