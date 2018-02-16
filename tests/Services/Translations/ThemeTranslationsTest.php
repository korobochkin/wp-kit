<?php
namespace Korobochkin\WPKit\Tests\Services\Translations;

/**
 * Class ThemeTranslationsTest
 */
class ThemeTranslationsTest extends \WP_UnitTestCase
{
    public function testLoadTranslations()
    {
        $path = get_theme_roots();
        var_dump($path);
        //'/test-plugin-domain/';
        //$stub = new PluginTranslations('test-plugin-domain', $path);

        //$this->assertEquals($stub, $stub->loadTranslations());
    }
}
