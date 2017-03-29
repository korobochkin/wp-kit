<?php
namespace Korobochkin\WPKit\Options;

/**
 * This class can be used for dynamic options (from other plugins or for managing default WP options).
 */
class Option extends AbstractOption {

	public function buildConstraint() {
		return null;
	}
}
