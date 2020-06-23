<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Sanitizers;

/**
 * Class DateTimeISO8601Sanitizer
 * @package Korobochkin\WPKit\Sanitizers
 */
class DateTimeISO8601Sanitizer implements SanitizerInterface
{
    /**
     * @param $value string String representing the time.
     *
     * @return bool|\DateTime Instance or false on failure.
     */
    public static function sanitize($value)
    {
        return \DateTime::createFromFormat(\DateTime::ISO8601, $value);
    }
}
