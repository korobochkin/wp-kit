<?php
namespace Korobochkin\WPKit\Sanitizers;

class DateTimeSanitizer implements SanitizerInterface {

	public static function sanitize($value) {
		try {
			return new \DateTime($value);
		}
		catch(\Exception $exception) {
			return false;
		}
	}
}
