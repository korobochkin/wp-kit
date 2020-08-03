<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits;

trait PostIdTrait
{
    /**
     * @var int Unique Post ID.
     */
    protected $postId;

    /**
     * Returns the post ID.
     *
     * @return int Post ID.
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set the post ID.
     *
     * @param int $id
     *
     * @return $this For chain calls.
     */
    public function setPostId($id)
    {
        $this->postId = $id;

        return $this;
    }
}
