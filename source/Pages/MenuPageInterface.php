<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Pages;

/**
 * Interface MenuPageInterface represents top level admin pages in menu.
 */
interface MenuPageInterface extends PageInterface
{
    /**
     * Returns the page icon.
     *
     * @return string Page icon name or base-64 encoded.
     */
    public function getIcon();

    /**
     * Sets the page icon.
     *
     * @param string $icon Page icon.
     *
     * @return $this For chain calls.
     */
    public function setIcon($icon);

    /**
     * Returns the page position.
     *
     * @return int Page position.
     */
    public function getPosition();

    /**
     * Sets the page position.
     *
     * @param int $position Page position.
     *
     * @return $this For chain calls.
     */
    public function setPosition($position);
}
