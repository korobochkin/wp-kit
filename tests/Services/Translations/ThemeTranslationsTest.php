<?php
namespace Korobochkin\WPKit\Tests\Services\Translations;

use Korobochkin\WPKit\Services\Translations\ThemeTranslations;

/**
 * Class ThemeTranslationsTest
 */
class ThemeTranslationsTest extends \WP_UnitTestCase
{
    public function testLoadTranslations()
    {
        $path = get_template_directory() . '/test-theme-domain/';
        $stub = new ThemeTranslations('test-theme-domain', $path);

        $this->assertEquals($stub, $stub->loadTranslations());
    }
}
