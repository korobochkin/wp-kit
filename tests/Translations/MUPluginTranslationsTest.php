<?php
namespace Korobochkin\WPKit\Tests\Translations;

use Korobochkin\WPKit\Tests\DataSets\EverythingSet;
use Korobochkin\WPKit\Translations\MUPluginTranslations;

class MUPluginTranslationsTest extends \WP_UnitTestCase
{
    /**
     * @inheritdoc
     */
    public function setUp()
    {
        parent::setUp();
        add_filter('locale', array($this, 'filterLocale'));
    }

    /**
     * @param string $locale The locale ID.
     * @return string Modified locale.
     */
    public function filterLocale($locale)
    {
        return 'ru_RU';
    }

    public function testLoadTranslations()
    {
        $path = WPMU_PLUGIN_DIR . '/test-plugin/';
        $stub = new MUPluginTranslations('wp-kit-example', $path);

        $this->assertSame($stub, $stub->loadTranslations());
    }

    public function testTranslationsWorks()
    {
        $reflection  = new \ReflectionClass(EverythingSet::class);
        $source      = dirname($reflection->getFileName()) . '/Translations/wp-kit-example-ru_RU.mo';
        $destination = WPMU_PLUGIN_DIR . '/wp-kit-example/translations/';
        var_dump($source, $destination);
        mkdir($destination, FS_CHMOD_DIR, true);
        copy($source, $destination);

        $stub = new MUPluginTranslations('wp-kit-example', $destination);
        $stub->loadTranslations();

        $this->assertSame('Привет', __('Hi', 'wp-kit-example'));
        $this->assertSame('Коментарий', _n('Comment', 'Comments', 1, 'wp-kit-example'));
        $this->assertSame('Коментария', _n('Comment', 'Comments', 2, 'wp-kit-example'));
        $this->assertSame('Коментариев', _n('Comment', 'Comments', 5, 'wp-kit-example'));
    }
}
