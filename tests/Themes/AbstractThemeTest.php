<?php
namespace Korobochkin\WPKit\Tests\Themes;

use Korobochkin\WPKit\Themes\AbstractTheme;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AbstractThemeTest
 */
class AbstractThemeTest extends \WP_UnitTestCase
{
    /**
     * @var AbstractTheme
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForAbstractClass(AbstractTheme::class);
    }

    public function testGetContainer()
    {
        $this->assertNull($this->stub->getContainer());

        $this->stub->setContainer(new ContainerBuilder());
    }

    public function testSetContainer()
    {
        $container = new ContainerBuilder();
        $this->assertEquals($this->stub, $this->stub->setContainer($container));
        $this->assertEquals($container, $this->stub->getContainer());
    }

    public function testGetDir()
    {
        global $wp_version;

        if ($wp_version == '4.0') {
            $path = '/tmp/wordpress/wp-content/themes/twentyfourteen';
        } else {
            $path = '/tmp/wordpress-tests-lib/includes/../data/themedir1/default';
        }

        $this->assertEquals($path, $this->stub->getDir());
    }

    public function testGetUrl()
    {
        global $wp_version;

        if ($wp_version == '4.0') {
            $url = 'http://example.org/wp-content/themes/twentyfourteen';
        } else {
            $url = '/tmp/wordpress-tests-lib/includes/../data/themedir1/default';
        }

        $this->assertEquals($url, $this->stub->getUrl());
    }
}