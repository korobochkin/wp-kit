<?php
namespace Korobochkin\WPKit\Tests\PostMeta\Special;

use Korobochkin\WPKit\PostMeta\Special\DateTimePostMeta;
use Korobochkin\WPKit\Tests\DataSets\DateTime\DateTimeTransformationSet;

/**
 * Class DateTimePostMetaTest
 * @package Korobochkin\WPKit\Tests\PostMeta\Special
 *
 * @group data-components
 */
class DateTimePostMetaTest extends \WP_UnitTestCase
{
    /**
     * @var DateTimePostMeta
     */
    protected $stub;

    /**
     * @var int Post ID for accessing post meta.
     */
    protected $postId;

    /**
     * Prepare option for tests.
     */
    public function setUp()
    {
        parent::setUp();

        $this->postId = wp_insert_post(
            array(
                'post_content' => 'WP Kit demo post.',
                'post_title'   => 'WP Kit demo title',
            )
        );

        $this->stub = new DateTimePostMeta();
        $this->stub->setName('wp_kit_datetime_post_meta');
        $this->stub->setPostId($this->postId);
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
            $this->assertEquals($expected, $this->stub->get());
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
        $this->assertEquals('', $this->stub->get());
    }
}
