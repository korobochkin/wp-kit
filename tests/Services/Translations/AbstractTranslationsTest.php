<?php
namespace Korobochkin\WPKit\Tests\Services\Translations;

use Korobochkin\WPKit\Services\Translations\AbstractTranslations;

/**
 * Class AbstractTranslationsTest
 */
class AbstractTranslationsTest extends \WP_UnitTestCase
{
    /**
     * @var AbstractTranslations
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForAbstractClass(
            AbstractTranslations::class,
            array(
                'test-textdomain',
                '/var/www/www-test/wp-content/plugins/test-plugin/translations/',
            )
        );
    }

    public function testConstructor()
    {
        $this->assertEquals('test-textdomain', $this->stub->getTextDomain());
        $this->assertEquals(
            '/var/www/www-test/wp-content/plugins/test-plugin/translations/',
            $this->stub->getTranslationsPath()
        );
    }

    public function testGetterAndSetterTextDomain()
    {
        $value = 'test-wp-kit-text-domain';

        $this->assertNull($this->stub->getTextDomain());
        $this->assertEquals($this->stub, $this->stub->setTextDomain($value));
        $this->assertEquals($value, $this->stub->getTextDomain());
    }

    public function testGetterAndSetterTranslationsPath()
    {
        $value = '/var/www/wp-kit/wp-content/plugins/test-plugin/translations/';

        $this->assertNull($this->stub->getTranslationsPath());
        $this->assertEquals($this->stub, $this->stub->setTranslationsPath($value));
        $this->assertEquals($value, $this->stub->getTranslationsPath());
    }
}
