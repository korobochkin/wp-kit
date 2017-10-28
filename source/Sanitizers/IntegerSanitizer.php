<?php
namespace Korobochkin\WPKit\Sanitizers;

/**
 * Class IntegerSanitizer
 * @package Korobochkin\WPKit\Sanitizers
 */
class IntegerSanitizer implements SanitizerInterface
{
    public static function sanitize($value)
    {
        if (is_object($value)) {
            return 1;
        }

        return (int) $value;
    }
}
