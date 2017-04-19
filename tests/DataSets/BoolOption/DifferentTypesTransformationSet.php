<?php
namespace Korobochkin\WPKit\Tests\DataSets\BoolOption;

use Korobochkin\WPKit\Tests\DataSets\AbstractDataSet;
use Symfony\Component\Form\Exception\TransformationFailedException;

class DifferentTypesTransformationSet extends AbstractDataSet {

	/**
	 * DifferentTypesAndTransformationSet constructor.
	 */
	public function __construct() {
		$variants = array(
			array(NULL,        true),

			array(true,        true),
			array(false,       false),

			array(1234,        TransformationFailedException::class),
			array(0,           TransformationFailedException::class),
			array(-1234,       TransformationFailedException::class),
			array(PHP_INT_MAX, TransformationFailedException::class),
			//array(PHP_INT_MIN, true),

			array(1.234,       TransformationFailedException::class),
			array(1.2e3,       TransformationFailedException::class),
			array(7E-10,       TransformationFailedException::class),
			array(-1.234,      TransformationFailedException::class),
			array(-1.2e3,      TransformationFailedException::class),
			array(-7E-10,      TransformationFailedException::class),

			array('1',         TransformationFailedException::class),
			array('VALUE',     TransformationFailedException::class),
			array('true',      TransformationFailedException::class),
			array('false',     TransformationFailedException::class),
			array('',          TransformationFailedException::class),
			array('0',         TransformationFailedException::class),

			array(array(),     TransformationFailedException::class),
			array(array(1),    TransformationFailedException::class),
			array(array(1, 2), TransformationFailedException::class),
			array(array(''),   TransformationFailedException::class),
			array(array('1'),  TransformationFailedException::class),
			array(array('0'),  TransformationFailedException::class),

			array(new \stdClass(), TransformationFailedException::class),
			array(new \WP_Query(), TransformationFailedException::class),
		);

		// Only for PHP 7
		if(PHP_VERSION_ID >= 70000) {
			$values[] = array(PHP_INT_MIN, TransformationFailedException::class);
		}

		$this->variants = $variants;
		$this->position = 0;
	}
}
