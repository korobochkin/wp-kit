<?php
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
        return (float) $value;
    }
}
