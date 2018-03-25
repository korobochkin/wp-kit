<?php
namespace Korobochkin\WPKit\Tests\TermMeta\Special;

use Korobochkin\WPKit\TermMeta\Special\DateTimeTermMeta;
use Korobochkin\WPKit\Tests\DataSets\DateTime\DateTimeTransformationSet;
use Korobochkin\WPKit\Utils\WordPressFeatures;

/**
 * Class DateTimeTermMetaTest
 * @package Korobochkin\WPKit\Tests\TermMeta\Special
 *
 * @group data-components
 */
class DateTimeTermMetaTest extends \WP_UnitTestCase
{
    /**
     * @var DateTimeTermMeta
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

        $this->stub = new DateTimeTermMeta();
        $this->stub->setName('wp_kit_datetime_term_meta');
        $this->stub->setTermId($this->termId);
    }

    /**
     * @dataProvider casesTypes
     * @var $value mixed Value to insert and test.
     * @var $expected mixed Value to compare output value with.
     */
    public function testTypes($value, $expected)
    {
        $this->stub->set($value);

        if (is_a($expected, \DateTime::class)) {
            $this->stub->flush();
            $this->assertSame($expected, $this->stub->get());
        } else {
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
        }
    }

    public function casesTypes()
    {
        return new DateTimeTransformationSet();
    }

    public function testNull()
    {
        $this->stub->set(null);
        $this->assertSame('', $this->stub->get());
    }
}
