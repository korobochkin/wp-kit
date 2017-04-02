<?php
namespace Korobochkin\WPKit\Options\Special;

use Korobochkin\WPKit\Options\AbstractOption;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Validator\Constraints;

class DateTimeOption extends AbstractOption {

	/**
	 * DateTimeOption constructor.
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
