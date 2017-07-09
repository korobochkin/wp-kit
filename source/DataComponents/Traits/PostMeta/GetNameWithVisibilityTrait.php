<?php
namespace Korobochkin\WPKit\DataComponents\Traits\PostMeta;

use Korobochkin\WPKit\PostMeta\PostMetaInterface;

trait GetNameWithVisibilityTrait {

    public function getName() {
        /**
         * @var $this PostMetaInterface
         */
        if(!$this->isVisible()) {
            return '_' . $this->name;
        }

        return $this->name;
    }
}
