<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Pages;

use Korobochkin\WPKit\Pages\PageInterface;
use Korobochkin\WPKit\Pages\Views\PageViewInterface;

class PageTestingPurposesView implements PageViewInterface
{
    /**
     * @param PageInterface $page
     */
    public function render(PageInterface $page)
    {
        echo '<div class="wp-kit-test-page-wrapper"><h1>' . $page->getPageTitle() . '</h1><p>Page text.</p></div>';
    }
}
