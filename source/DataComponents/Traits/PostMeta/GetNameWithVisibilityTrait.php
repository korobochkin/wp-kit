<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits\PostMeta;

use Korobochkin\WPKit\PostMeta\PostMetaInterface;

/**
 * Trait GetNameWithVisibilityTrait
 * @package Korobochkin\WPKit\DataComponents\Traits\PostMeta
 */
trait GetNameWithVisibilityTrait
{

    public function getName()
    {
        /**
         * @var $this PostMetaInterface
         */
        if (!$this->isVisible()) {
            return '_'.$this->name;
        }

        return $this->name;
    }
}
