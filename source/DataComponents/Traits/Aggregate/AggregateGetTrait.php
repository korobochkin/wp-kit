<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits\Aggregate;

/**
 * Trait AggregateGetTrait
 */
trait AggregateGetTrait
{
    /**
     * @inheritdoc
     */
    public function get()
    {
        /**
         * @var $this \Korobochkin\WPKit\Options\OptionInterface|\Korobochkin\WPKit\Transients\TransientInterface
         */
        if ($this->hasLocalValue()) {
            return $this->getLocalValue();
        }

        $raw = $this->getValueFromWordPress();

        if ($raw !== false) {
            $transformer = $this->getDataTransformer();
            if ($transformer) {
                $raw = $transformer->reverseTransform($raw);
            }
            unset($transformer);

            if (isset($this->defaultValue)) {
                // Replace default values with saved data.
                return array_replace_recursive($this->getDefaultValue(), $raw);
            } else {
                return $raw;
            }
        }

        return $this->getDefaultValue();
    }
}
