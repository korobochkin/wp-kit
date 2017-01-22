<?php
namespace Korobochkin\WPKit\Options;

use Symfony\Component\Validator\Constraints;

class BoolOption extends AbstractBoolOption {

	public function buildConstraint() {
		new Constraints\Type(array(
			'type' => 'bool'
		));
	}

	public function sanitize($instance) {
		if(is_bool($instance))
			return $instance;

		if($instance == 1 || $instance === 'true')
			return true;
		else
			return false;
	}

}
