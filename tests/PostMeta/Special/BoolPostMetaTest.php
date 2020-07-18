<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\PostMeta\Special;

use Korobochkin\WPKit\PostMeta\Special\BoolPostMeta;
use Korobochkin\WPKit\Tests\Common\DataComponents\Special\AbstractBoolDataComponentTest;

/**
 * Class BoolPostMetaTest
 * @package Korobochkin\WPKit\Tests\PostMeta\Special
 *
 * @group data-components
 */
class BoolPostMetaTest extends AbstractBoolDataComponentTest
{
    /**
     * @var int Post ID for accessing post meta.
     */
    protected $postId;

    /**
     * @return BoolPostMeta
     */
    protected function createAndConfigureStub()
    {
        $this->postId = wp_insert_post(array(
            'post_content' => 'WP Kit demo post.',
            'post_title'   => 'WP Kit demo title',
        ));

        $stub = new BoolPostMeta();
        $stub->setName('wp_kit_bool_post_meta');
        $stub->setPostId($this->postId);

        return $stub;
    }
}
