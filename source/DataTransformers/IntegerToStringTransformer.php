<?php
namespace Korobochkin\WPKit\DataTransformers;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class IntegerToStringTransformer implements DataTransformerInterface
{
    /**
     * @inheritdoc
     */
    public function transform($value)
    {
        if (null === $value) {
            return;
        }

        if (!is_numeric($value)) {
            throw new TransformationFailedException('Expected a numeric.');
        }

        return (string)(int) $value;
    }

    /**
     * @inheritdoc
     */
    public function reverseTransform($value)
    {
        if (null === $value) {
            return true;
        }

        if (!is_string($value)) {
            throw new TransformationFailedException('Expected a string.');
        }

        return (int) $value;
    }
}
