<?php
namespace Korobochkin\WPKit\Tests\Services\Translations;

use Korobochkin\WPKit\Translations\PluginTranslations;

/**
 * Class PluginTranslationsTest
 */
class PluginTranslationsTest extends \WP_UnitTestCase
{
    public function testLoadTranslations()
    {
        $path = WP_PLUGIN_DIR . '/test-plugin-domain/';
        $stub = new PluginTranslations('test-plugin-domain', $path);

        $this->assertSame($stub, $stub->loadTranslations());
    }
}
