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
        var_dump(array(
            'getDir' => $this->stub->getDir(),
        ));
        $this->assertSame(plugin_dir_path(__FILE__), $this->stub->getDir());
    }

    public function testGetUrl()
    {
        var_dump(array(
            'getUrl' => $this->stub->getUrl(),
        ));
        $this->assertSame(plugin_dir_url(__FILE__), $this->stub->getUrl());
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
