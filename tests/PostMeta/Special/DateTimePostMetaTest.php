<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\PostMeta\Special;

use Korobochkin\WPKit\PostMeta\Special\DateTimePostMeta;
use Korobochkin\WPKit\Tests\Common\DataComponents\Special\AbstractDateTimeDataComponentTest;

/**
 * Class DateTimePostMetaTest
 * @package Korobochkin\WPKit\Tests\PostMeta\Special
 *
 * @group data-components
 */
class DateTimePostMetaTest extends AbstractDateTimeDataComponentTest
{
    /**
     * @var int Post ID for accessing post meta.
     */
    protected $postId;

    /**
     * @return DateTimePostMeta
     */
    protected function createAndConfigureStub()
    {
        $this->postId = wp_insert_post(array(
            'post_content' => 'WP Kit demo post.',
            'post_title'   => 'WP Kit demo title',
        ));

        $stub = new DateTimePostMeta();
        $stub->setName('wp_kit_datetime_post_meta');
        $stub->setPostId($this->postId);

        return $stub;
    }
}
