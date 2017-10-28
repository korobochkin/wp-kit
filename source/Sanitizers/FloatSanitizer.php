<?php
namespace Korobochkin\WPKit\Sanitizers;

/**
 * Class FloatSanitizer
 * @package Korobochkin\WPKit\Sanitizers
 */
class FloatSanitizer implements SanitizerInterface
{
    public static function sanitize($value)
    {
        if (is_object($value)) {
            return 1.0;
        }

        return (float) $value;
    }
}
