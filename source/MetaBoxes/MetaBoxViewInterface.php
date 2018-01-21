<?php
namespace Korobochkin\WPKit\MetaBoxes;

/**
 * Interface MetaBoxViewInterface
 */
interface MetaBoxViewInterface
{
    /**
     * Output HTML markup for Meta Box.
     *
     * @param MetaBoxInterface $metaBox Meta box instance.
     */
    public function render(MetaBoxInterface $metaBox);
}
