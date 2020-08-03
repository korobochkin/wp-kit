<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\ScriptsStyles;

/**
 * Interface ScriptsStylesInterface
 */
interface ScriptsStylesInterface
{
    /**
     * Register all required scripts and styles in WordPress.
     *
     * @return $this For chain calls.
     */
    public function register();

    /**
     * Returns base url.
     *
     * @return string Base url to assets folder.
     */
    public function getBaseUrl();

    /**
     * Sets base url.
     *
     * @param string $baseUrl Base url to assets folder.
     *
     * @return $this For chain calls.
     */
    public function setBaseUrl($baseUrl);

    /**
     * Returns status of developer mode.
     *
     * @return bool Status of developer mode.
     */
    public function isDev();

    /**
     * Sets status of developer mode.
     *
     * @param bool $dev Status of developer mode.
     *
     * @return $this For chain calls.
     */
    public function setDev($dev);
}
