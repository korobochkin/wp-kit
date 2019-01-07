<?php
namespace Korobochkin\WPKit\Tests\MetaBoxes;

use Korobochkin\WPKit\MetaBoxes\MetaBoxInterface;
use Korobochkin\WPKit\MetaBoxes\MetaBoxViewInterface;

class MetaBoxTestingPurposesView implements MetaBoxViewInterface
{
    /**
     * @param MetaBoxInterface $metaBox
     */
    public function render(MetaBoxInterface $metaBox)
    {
        echo '<div class="wp-kit-test-meta-box">This is test Meta Box view instance. Title of Meta Box: <code>'
             . $metaBox->getTitle()
             .'</code></div>';
    }
}
