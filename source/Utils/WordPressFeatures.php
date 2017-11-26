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
}
