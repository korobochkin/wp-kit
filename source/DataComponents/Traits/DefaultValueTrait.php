<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits;

trait DefaultValueTrait
{
    /**
     * @var mixed
     */
    protected $defaultValue;

    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    public function hasDefaultValue()
    {
        return isset($this->defaultValue);
    }
}
