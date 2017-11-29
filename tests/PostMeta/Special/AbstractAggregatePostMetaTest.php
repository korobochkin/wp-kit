<?php
namespace Korobochkin\WPKit\Tests\PostMeta\Special;

use Korobochkin\WPKit\PostMeta\Special\AbstractAggregatePostMeta;
use Korobochkin\WPKit\Tests\DataSets\AggregateDataSet;

class AbstractAggregatePostMetaTest extends \WP_UnitTestCase
{

    /**
     * @var AbstractAggregatePostMeta
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

        $this->stub = $this->getMockForAbstractClass(AbstractAggregatePostMeta::class);

        $this->postId = wp_insert_post(
            array(
                'post_content' => 'WP Kit demo post.',
                'post_title'   => 'WP Kit demo title',
            )
        );

        $this->stub
            ->setName('wp_kit_AbstractAggregatePostMeta')
            ->setPostId($this->postId);
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
