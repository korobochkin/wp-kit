<?php
declare(strict_types=1);

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
        global $wp_version;

        if (substr($wp_version, 0, 3) === '4.0' && PHP_VERSION_ID >= 70200) {
            $this->markTestSkipped(
                'WordPress wp-includes/pomo/translations.php uses create_function() which is deprecated in PHP 7.2+.'
            );
        }

        $reflection  = new \ReflectionClass(EverythingSet::class);
        $source      = dirname($reflection->getFileName()) . '/Translations/wp-kit-example-ru_RU.mo';
        $destination = WPMU_PLUGIN_DIR . '/wp-kit-example/translations/';
        mkdir($destination, 0777, true);
        copy($source, $destination . 'wp-kit-example-ru_RU.mo');

        $stub = new MUPluginTranslations('wp-kit-example', '/wp-kit-example/translations/');
        $stub->loadTranslations();

        $this->assertSame('Привет', __('Hi', 'wp-kit-example'));
        $this->assertSame('Комментарий', _n('Comment', 'Comments', 1, 'wp-kit-example'));
        $this->assertSame('Комментария', _n('Comment', 'Comments', 2, 'wp-kit-example'));
        $this->assertSame('Комментариев', _n('Comment', 'Comments', 5, 'wp-kit-example'));
    }
}
