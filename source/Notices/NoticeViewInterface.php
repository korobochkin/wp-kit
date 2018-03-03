<?php
namespace Korobochkin\WPKit\Notices;

/**
 * Interface NoticeViewInterface
 */
interface NoticeViewInterface
{
    /**
     * Output HTML markup for Meta Box.
     *
     * @param NoticeInterface $notice Notice instance.
     */
    public function render(NoticeInterface $notice);
}
