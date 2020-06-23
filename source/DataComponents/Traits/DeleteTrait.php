<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits;

trait DeleteTrait
{
    /**
     * @inheritdoc
     */
    public function delete()
    {
        /**
         * @var $this \Korobochkin\WPKit\Options\OptionInterface|\Korobochkin\WPKit\Transients\TransientInterface
         */
        $result = $this->deleteFromWP();

        if ($result) {
            $this->setLocalValue(null);
        }

        return $result;
    }
}
