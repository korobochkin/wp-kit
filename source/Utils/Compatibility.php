<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Utils;

class Compatibility
{
    /**
     * Check for min version.
     *
     * @param $currentVersion string Current version in semantic versioning format.
     * @param $minimalVersion string Minimal version supported by product.
     *
     * @return bool True if current version is higher or equal to min version.
     */
    public static function checkForMinimalVersion($currentVersion, $minimalVersion)
    {
        $result = version_compare($currentVersion, $minimalVersion);

        if ($result >= 0) {
            return true;
        }

        return false;
    }

    /**
     * Check that WordPress has minimal allowed version for your product.
     *
     * @param $minimalVersion string Version in semantic versioning format.
     *
     * @return bool True if your code passed the minimal WordPress version.
     */
    public static function checkWordPress($minimalVersion)
    {
        global $wp_version;

        return self::checkForMinimalVersion($wp_version, $minimalVersion);
    }
}
