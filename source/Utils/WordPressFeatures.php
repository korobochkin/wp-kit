<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Utils;

class WordPressFeatures
{
    /**
     * @return bool True if WordPress supported terms meta.
     */
    public static function isTermsMetaSupported()
    {
        return Compatibility::checkWordPress('4.4');
    }

    /**
     * WordPress Debug mode.
     *
     * @return bool True if debug mode enabled.
     */
    public static function isDebug()
    {
        if (defined('WP_DEBUG') && WP_DEBUG == true) {
            return true;
        }

        return false;
    }

    /**
     * Script Debug mode.
     *
     * @return bool True if Script Debug mode enabled.
     */
    public static function isScriptDebug()
    {
        if (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG == true) {
            return true;
        }

        return false;
    }
}
