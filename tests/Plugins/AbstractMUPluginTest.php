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
        $file = '/srv/www/wordpress/wp-content/mu-plugins/wp-kit-example/plugin.php';
        $this->stub->setFile($file);
        var_dump(array(
            'getDir' => $this->stub->getDir(),
        ));
        $this->assertSame(plugin_dir_path($file), $this->stub->getDir());
    }

    public function testGetUrl()
    {
        $file = '/tmp/wordpress/wp-content/mu-plugins/wp-kit-example/plugin.php';
        $this->stub->setFile($file);
        var_dump(array(
            'getUrl' => $this->stub->getUrl(),
            'WPMU_PLUGIN_DIR' => WPMU_PLUGIN_DIR,
            'plugin_dir_url' => plugin_dir_url($file),
        ));
        $this->assertSame(plugin_dir_url($file), $this->stub->getUrl());
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
