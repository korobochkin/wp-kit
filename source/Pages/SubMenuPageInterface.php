<?php
namespace Korobochkin\WPKit\Pages;

interface SubMenuPageInterface extends PageInterface
{
    public function setParentSlug($slug);

    public function getParentSlug();
}
