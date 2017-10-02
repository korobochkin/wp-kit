<?php
namespace Korobochkin\WPKit\Sanitizers;

/**
 * Class DateTimeISO8601Sanitizer
 * @package Korobochkin\WPKit\Sanitizers
 */
class DateTimeISO8601Sanitizer implements SanitizerInterface
{
    public static function sanitize($value)
    {
        try {
            return \DateTime::createFromFormat(\DateTime::ISO8601, $value);
        } catch (\Exception $exception) {
            return false;
        }
    }

    public static function toString(\DateTime $value)
    {
        return $value->format(\DateTime::ISO8601);
    }
}
