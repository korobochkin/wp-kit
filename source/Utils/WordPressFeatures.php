<?php
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
        return defined('WP_DEBUG') && WP_DEBUG == true;
    }

    /**
     * Script Debug mode.
     *
     * @return bool True if Script Debug mode enabled.
     */
    public static function isScriptDebug()
    {
        return defined('SCRIPT_DEBUG') && SCRIPT_DEBUG == true;
    }

    /**
     * Check for wordpress.com environment.
     *
     * @return bool True if WordPress.com env, false otherwise.
     */
    public static function isVIP()
    {
        return defined('WPCOM_IS_VIP_ENV') && true === WPCOM_IS_VIP_ENV;
    }
}
