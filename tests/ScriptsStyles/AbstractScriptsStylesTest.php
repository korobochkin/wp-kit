<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\ScriptsStyles;

use Korobochkin\WPKit\ScriptsStyles\AbstractScriptsStyles;

class AbstractScriptsStylesTest extends \WP_UnitTestCase
{
    /**
     * @var AbstractScriptsStyles
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();

        $this->stub = $this->getMockForAbstractClass(
            AbstractScriptsStyles::class,
            array(
                null,
                null,
            )
        );
    }

    public function testConstruct()
    {
        /**
         * @var $stub AbstractScriptsStyles
         */
        $stub = $this->getMockForAbstractClass(
            AbstractScriptsStyles::class,
            array(
                'http://example.org/wp-content/plugins/wp-kit-based-plugin/',
                false,
            )
        );

        $this->assertSame(
            'http://example.org/wp-content/plugins/wp-kit-based-plugin/',
            $stub->getBaseUrl()
        );
        $this->assertFalse($stub->isDev());
    }

    public function testGetterAndSetterBaseUrl()
    {
        $value = 'http://example.org/wp-content/plugins/wp-kit-based-plugin/';
        $this->assertNull($this->stub->getBaseUrl());
        $this->assertSame($this->stub, $this->stub->setBaseUrl($value));
        $this->assertSame($value, $this->stub->getBaseUrl());
    }

    public function testGetterAndSetterDev()
    {
        $value = true;
        $this->assertNull($this->stub->isDev());
        $this->assertSame($this->stub, $this->stub->setDev($value));
        $this->assertSame($value, $this->stub->isDev());
    }
}
