<?php
namespace Korobochkin\WPKit\DataComponents\Traits;

trait SetTrait
{
    /**
     * @inheritdoc
     */
    public function set($value)
    {
        /**
         * @var $this \Korobochkin\WPKit\DataComponents\NodeInterface
         */
        $this->setLocalValue($value);

        return $this;
    }
}
