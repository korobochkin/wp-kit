<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits;

trait VisibilityTrait
{
    /**
     * @var bool True if visible, false if not.
     */
    protected $visibility = false;

    /**
     * Returns visibility flag for post meta.
     *
     * @return bool True if meta visible, false otherwise.
     */
    public function isVisible()
    {
        return $this->visibility;
    }

    /**
     * Set the visibility for meta.
     *
     * @param $visibility bool Should this meta be visible or not.
     *
     * @return $this For chain calls.
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;

        return $this;
    }
}
