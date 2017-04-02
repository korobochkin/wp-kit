<?php
namespace Korobochkin\WPKit\Transients\Special;

use Korobochkin\WPKit\Transients\AbstractTransient;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Validator\Constraints;

class DateTimeTransient extends AbstractTransient {

	/**
	 * DateTimeTransient constructor.
	 */
	public function __construct() {
		$this->setDataTransformer(new DateTimeToStringTransformer());
	}

	public function buildConstraint() {
		return array(
			new Constraints\NotBlank(),
			new Constraints\DateTime(),
		);
	}
}
