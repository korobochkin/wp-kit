<?php
namespace Korobochkin\WPKit\DataTransformers;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class IntegerToStringTransformer
 */
class IntegerToStringTransformer implements DataTransformerInterface
{
    /**
     * Transforms a Integer into a string.
     *
     * @param integer $value Integer value
     *
     * @return string String value
     *
     * @throws TransformationFailedException If the given value is not a integer.
     */
    public function transform($value)
    {
        if (null === $value) {
            return '0';
        }

        if (!is_int($value)) {
            throw new TransformationFailedException('Expected a Integer.');
        }

        return (string) $value;
    }

    /**
     * Transforms a string into a Integer.
     *
     * @param string $value String value
     *
     * @return int Integer value
     *
     * @throws TransformationFailedException If the given value is not a string.
     */
    public function reverseTransform($value)
    {
        if (null === $value) {
            return 0;
        }

        if (!is_string($value)) {
            throw new TransformationFailedException('Expected a string.');
        }

        return (int) $value;
    }
}
