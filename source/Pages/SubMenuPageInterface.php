<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Pages;

/**
 * Interface SubMenuPageInterface for child pages.
 */
interface SubMenuPageInterface extends PageInterface
{
    /**
     * Returns parent page.
     *
     * @return MenuPageInterface Parent page.
     */
    public function getParentPage();

    /**
     * Sets parent page.
     *
     * @param MenuPageInterface $page Parent page.
     *
     * @return $this For chain calls.
     */
    public function setParentPage(MenuPageInterface $page);

    /**
     * Returns parent page slug.
     *
     * @return string Parent slug.
     */
    public function getParentSlug();

    /**
     * Sets parent page slug.
     *
     * @param $slug string Parent slug.
     *
     * @return $this For chain calls.
     */
    public function setParentSlug($slug);
}
