<?php
namespace Korobochkin\WPKit\Tests\PostMeta\Special;

use Korobochkin\WPKit\PostMeta\Special\NumericPostMeta;
use Korobochkin\WPKit\Tests\DataSets\Numeric\NumericTransformationSet;

/**
 * Class NumericPostMetaTest
 * @package Korobochkin\WPKit\Tests\PostMeta\Special
 *
 * @group data-components
 */
class NumericPostMetaTest extends \WP_UnitTestCase
{

    /**
     * @var NumericPostMeta
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

        $this->stub = new NumericPostMeta();
        $this->stub->setName('wp_kit_numeric_post_meta');
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
        $this->assertSame($value, $this->stub->get());
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
