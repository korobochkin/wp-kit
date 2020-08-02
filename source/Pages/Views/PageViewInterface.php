<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Pages\Views;

use Korobochkin\WPKit\Pages\PageInterface;

/**
 * Interface PageViewInterface
 */
interface PageViewInterface
{
    /**
     * Output HTML markup for the page.
     *
     * @param PageInterface $page Page instance.
     */
    public function render(PageInterface $page);
}
