<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits;

use Symfony\Component\Form\DataTransformerInterface;

trait DataTransformerTrait
{
    /**
     * @var DataTransformerInterface
     */
    protected $dataTransformer;

    /**
     * Get DataTransformer.
     *
     * @return DataTransformerInterface
     */
    public function getDataTransformer()
    {
        return $this->dataTransformer;
    }

    /**
     * Setup DataTransformer.
     *
     * @param DataTransformerInterface $transformer
     *
     * @return $this For chain calls.
     */
    public function setDataTransformer(DataTransformerInterface $transformer)
    {
        $this->dataTransformer = $transformer;

        return $this;
    }
}
