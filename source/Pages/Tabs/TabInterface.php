<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Pages\Tabs;

/**
 * Interface TabInterface
 */
interface TabInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return $this For chain calls.
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     *
     * @return $this For chain calls.
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getUrl();

    /**
     * @param string $url
     *
     * @return $this For chain calls.
     */
    public function setUrl($url);

    /**
     * @return bool
     */
    public function isActive();

    /**
     * @return $this For chain calls.
     */
    public function markActive();

    /**
     * @return $this For chain calls.
     */
    public function markUnActive();
}
