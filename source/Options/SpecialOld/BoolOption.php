<?php
namespace Korobochkin\WPKit\Options\SpecialOld;

use Symfony\Component\Validator\Constraints;

class BoolOption extends AbstractSpecialOption {

	protected $sanitizer = array('Korobochkin\WPKit\Sanitizers\BoolSanitizer', 'sanitize');

	/**
	 * @inheritdoc
	 */
	public function buildConstraint() {
		new Constraints\Type(array(
			'type' => 'bool'
		));
	}
}
