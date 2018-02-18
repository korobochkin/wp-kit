<?php
namespace Korobochkin\WPKit\Tests\Services\Translations;

use Korobochkin\WPKit\Services\Translations\PluginTranslations;

/**
 * Class PluginTranslationsTest
 */
class PluginTranslationsTest extends \WP_UnitTestCase
{
    public function testLoadTranslations()
    {
        $path = WP_PLUGIN_DIR . '/test-plugin-domain/';
        $stub = new PluginTranslations('test-plugin-domain', $path);

        $this->assertEquals($stub, $stub->loadTranslations());
    }
}
