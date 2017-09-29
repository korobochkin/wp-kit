<?php
namespace Korobochkin\WPKit\Themes;

/**
 * Class AbstractTheme
 * @package Korobochkin\WPKit\Themes
 */
abstract class AbstractTheme implements ThemeInterface
{
    /**
     * @inheritdoc
     */
    public function getDir()
    {
        $path = get_stylesheet_directory();

        return $path;
    }

    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        $uri = get_stylesheet_directory_uri();

        return $uri;
    }
}
