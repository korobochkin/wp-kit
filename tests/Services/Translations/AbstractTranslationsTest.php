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
}
