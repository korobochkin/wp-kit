<?php
namespace Korobochkin\WPKit\Pages\Views;

use Korobochkin\WPKit\Pages\PageInterface;

interface PageViewInterface
{
    public function render(PageInterface $page);
}
