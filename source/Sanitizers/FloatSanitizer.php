<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Sanitizers;

/**
 * Class FloatSanitizer
 * @package Korobochkin\WPKit\Sanitizers
 */
class FloatSanitizer implements SanitizerInterface
{
    /**
     * @param $value mixed Any types of values.
     *
     * @return float Value converted to float.
     */
    public static function sanitize($value)
    {
        if (is_object($value)) {
            return 1.0;
        }

        return (float) $value;
    }
}
