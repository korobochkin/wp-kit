<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits;

trait GetTrait
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
                return $transformer->reverseTransform($raw);
            }

            return $raw;
        }

        return $this->getDefaultValue();
    }
}
