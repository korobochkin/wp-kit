<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\PostMeta\Special;

use Korobochkin\WPKit\PostMeta\Special\NumericPostMeta;
use Korobochkin\WPKit\Tests\Common\DataComponents\Special\AbstractNumericDataComponentTest;

/**
 * Class NumericPostMetaTest
 * @package Korobochkin\WPKit\Tests\PostMeta\Special
 *
 * @group data-components
 */
class NumericPostMetaTest extends AbstractNumericDataComponentTest
{
    /**
     * @var int Post ID for accessing post meta.
     */
    protected $postId;

    /**
     * @return NumericPostMeta
     */
    protected function createAndConfigureStub()
    {
        $this->postId = wp_insert_post(array(
            'post_content' => 'WP Kit demo post.',
            'post_title'   => 'WP Kit demo title',
        ));

        $stub = new NumericPostMeta();
        $stub->setName('wp_kit_numeric_post_meta');
        $stub->setPostId($this->postId);

        return $stub;
    }
}
