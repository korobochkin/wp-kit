<?php

namespace Korobochkin\WPKit\Tests\Plugins;

use Korobochkin\WPKit\Plugins\AbstractMUPlugin;

class AbstractMUPluginTest extends \WP_UnitTestCase
{
    /**
     * @var AbstractMUPlugin
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForAbstractClass(
            AbstractMUPlugin::class,
            array(__FILE__)
        );
    }

    public function testGetDir()
    {
        $input    = '/tmp/wordpress/wp-content/mu-plugins/wp-kit-example/plugin.php';
        $expected = '/tmp/wordpress/wp-content/mu-plugins/wp-kit-example/';
        $this->stub->setFile($input);

        $this->assertSame($expected, $this->stub->getDir());
    }

    public function testGetUrl()
    {
        $input    = '/tmp/wordpress/wp-content/mu-plugins/wp-kit-example/plugin.php';
        $expected = 'http://example.org/wp-content/mu-plugins/wp-kit-example/';
        $this->stub->setFile($input);

        $this->assertSame($expected, $this->stub->getUrl());
    }

    /**
     * @dataProvider casesGetBasename
     *
     * @param $plugin string Plugin path.
     */
    public function testGetBasename($plugin)
    {
        $this->stub->setFile(path_join(WPMU_PLUGIN_DIR, $plugin));

        $this->assertSame($plugin, $this->stub->getBaseName());
    }

    /**
     * @return array
     */
    public function casesGetBasename()
    {
        return array(
            array(
                'hello.php',
            ),
            array(
                'wp-mu-example/wp-mu-example.php',
            ),
        );
    }
}
