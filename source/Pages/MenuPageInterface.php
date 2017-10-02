<?php
namespace Korobochkin\WPKit\Pages;

interface MenuPageInterface extends PageInterface
{
    /**
     * @return string
     */
    public function getIcon();

    /**
     * @param string $icon
     *
     * @return $this For chain calls.
     */
    public function setIcon($icon);

    /**
     * @return int
     */
    public function getPosition();

    /**
     * @param int $position
     *
     * @return $this For chain calls.
     */
    public function setPosition($position);
}
