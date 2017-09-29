<?php
namespace Korobochkin\WPKit\Tests\PostMeta\Special;

use Korobochkin\WPKit\PostMeta\Special\BoolPostMeta;
use Korobochkin\WPKit\Tests\DataSets\Bool\BoolTransformationSet;

/**
 * Class BoolPostMetaTest
 * @package Korobochkin\WPKit\Tests\PostMeta\Special
 *
 * @group data-components
 */
class BoolPostMetaTest extends \WP_UnitTestCase
{
    /**
     * @var BoolPostMeta
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

        $this->stub = new BoolPostMeta();
        $this->stub->setName('wp_kit_bool_post_meta');
        $this->stub->setPostId($this->postId);
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
            $this->assertEquals($expected, $this->stub->get());
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
            $this->assertEquals($value, $this->stub->get());
        } else {
            $this->assertEquals($expected, $this->stub->get());
        }
    }

    public function casesTypesWithoutSaving()
    {
        return new BoolTransformationSet();
    }

    public function testDefaultValue()
    {
        $this->assertEquals(true, $this->stub->get());
    }
}
