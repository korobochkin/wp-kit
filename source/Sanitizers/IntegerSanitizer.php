<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Sanitizers;

/**
 * Class IntegerSanitizer
 * @package Korobochkin\WPKit\Sanitizers
 */
class IntegerSanitizer implements SanitizerInterface
{
    /**
     * @param $value mixed Any types of values.
     *
     * @return int Value converted to int.
     */
    public static function sanitize($value)
    {
        if (is_object($value)) {
            return 1;
        }

        return (int) $value;
    }
}
