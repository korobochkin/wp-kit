<?php
namespace Korobochkin\WPKit\DataComponents\Traits;

use Symfony\Component\Form\DataTransformerInterface;

trait DataTransformerTrait {

	protected $dataTransformer;

	public function getDataTransformer() {
		return $this->dataTransformer;
	}

	public function setDataTransformer(DataTransformerInterface $transformer) {
		$this->dataTransformer = $transformer;
		return $this;
	}
}
