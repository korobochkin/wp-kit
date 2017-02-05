<?php
namespace Korobochkin\WPKit\Options;

use Symfony\Component\Validator\Constraints;

class FloatOption extends AbstractOption {

	protected $sanitizer = array('Korobochkin\WPKit\Sanitizers\FloatSanitizer', 'sanitize');

	/**
	 * @inheritdoc
	 */
	public function buildConstraint() {
		new Constraints\Type(array(
			'type' => 'float'
		));
	}
}
