<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Sanitizers;

/**
 * Class BoolSanitizer
 * @package Korobochkin\WPKit\Sanitizers
 */
class BoolSanitizer implements SanitizerInterface
{
    /**
     * @param $value mixed Any types of values.
     *
     * @return bool Value converted to boolean.
     */
    public static function sanitize($value)
    {
        return (bool) $value;
    }
}
