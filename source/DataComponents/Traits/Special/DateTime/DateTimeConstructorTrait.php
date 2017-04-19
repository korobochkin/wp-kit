<?php
namespace Korobochkin\WPKit\DataComponents\Traits\Special\DateTime;

use Korobochkin\WPKit\DataComponents\NodeInterface;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;

trait DateTimeConstructorTrait {

	public function __construct() {
		/**
		 * @var $this NodeInterface
		 */
		$this->setDataTransformer(new DateTimeToStringTransformer());
	}
}
