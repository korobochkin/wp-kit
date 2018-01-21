<?php
namespace Korobochkin\WPKit\Sanitizers;

/**
 * Class BoolSanitizer
 * @package Korobochkin\WPKit\Sanitizers
 */
class BoolSanitizer implements SanitizerInterface
{
    public static function sanitize($value)
    {
        if (is_string($value)) {
            if ($value == '1') {
                return true;
            } elseif ($value == '0') {
                return false;
            }
        }

        return (bool) $value;
    }
}
