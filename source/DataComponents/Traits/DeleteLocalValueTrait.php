<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits;

use Korobochkin\WPKit\DataComponents\NodeInterface;

trait DeleteLocalValueTrait
{
    public function deleteLocal()
    {
        /**
         * @var $this NodeInterface
         */
        $this->setLocalValue(null);

        return true;
    }
}
