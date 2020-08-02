<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Sanitizers;

interface SanitizerInterface
{
    public static function sanitize($value);
}
