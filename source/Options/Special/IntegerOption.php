<?php
namespace Korobochkin\WPKit\Options\Special;

use Korobochkin\WPKit\Options\AbstractOption;
use Symfony\Component\Validator\Constraints;

class IntegerOption extends AbstractOption {

	protected $sanitizer = array('Korobochkin\WPKit\Sanitizers\IntegerSanitizer', 'sanitize');

	/**
	 * @inheritdoc
	 */
	public function buildConstraint() {
		new Constraints\Type(array(
			'type' => 'integer'
		));
	}
}
