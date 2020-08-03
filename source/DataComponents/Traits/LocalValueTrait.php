<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits;

trait LocalValueTrait
{
    /**
     * @var mixed
     */
    protected $localValue;

    public function getLocalValue()
    {
        return $this->localValue;
    }

    public function setLocalValue($value)
    {
        $this->localValue = $value;

        return $this;
    }

    public function hasLocalValue()
    {
        return isset($this->localValue);
    }
}
