<?php
namespace Korobochkin\WPKit\DataComponents\Traits;

use Symfony\Component\Form\DataTransformerInterface;

trait DataTransformerTrait {

	protected $dataTransformer;

	/**
	 * Get DataTransformer.
	 *
	 * @return DataTransformerInterface DataTransformer instance for this istance.
	 */
	public function getDataTransformer() {
		return $this->dataTransformer;
	}

	/**
	 * Setup DataTransformer.
	 *
	 * @param DataTransformerInterface $transformer Setup DataTransformer for this instance.
	 *
	 * @return $this For chain calls.
	 */
	public function setDataTransformer(DataTransformerInterface $transformer) {
		$this->dataTransformer = $transformer;
		return $this;
	}
}
