<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataTransformers;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class BooleanToStringTransformer
 * @package Korobochkin\WPKit\DataTransformers
 */
class BooleanToStringTransformer implements DataTransformerInterface
{
    /**
     * The value emitted upon transform if the input is true.
     *
     * @var string
     */
    private $trueValue;

    /**
     * @var string
     */
    private $falseValue;

    /**
     * Sets the value emitted upon transform if the input is true.
     *
     * @param string $trueValue
     * @param string $falseValue
     */
    public function __construct($trueValue, $falseValue)
    {
        $this->trueValue  = $trueValue;
        $this->falseValue = $falseValue;
    }

    /**
     * Transforms a Boolean into a string.
     *
     * @param bool $value Boolean value
     *
     * @return string String value
     *
     * @throws TransformationFailedException If the given value is not a Boolean.
     */
    public function transform($value)
    {
        if (null === $value) {
            return;
        }

        if (!is_bool($value)) {
            throw new TransformationFailedException('Expected a Boolean.');
        }

        return ($value) ? $this->trueValue : $this->falseValue;
    }

    /**
     * Transforms a string into a Boolean.
     *
     * @param string $value String value
     *
     * @return bool Boolean value
     *
     * @throws TransformationFailedException If the given value is not a string.
     */
    public function reverseTransform($value)
    {
        if (null === $value) {
            return true;
        }

        if (!is_string($value)) {
            throw new TransformationFailedException('Expected a string.');
        }

        if ($value === $this->falseValue) {
            return false;
        }

        return true;
    }
}
