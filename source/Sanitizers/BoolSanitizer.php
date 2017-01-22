<?php
namespace Korobochkin\WPKit\Sanitizers;

class BoolSanitizer implements SanitizerInterface {

	public static function sanitize($value) {
		return (bool)$value;
	}
}
