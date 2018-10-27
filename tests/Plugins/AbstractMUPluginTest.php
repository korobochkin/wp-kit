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

    /**
     * @dataProvider casesGetBasename
     *
     * @param $plugin string Plugin path.
     */
    public function testGetBasename($plugin)
    {
        var_dump($plugin);
        $this->stub->setFile(path_join(WPMU_PLUGIN_DIR, $plugin));

        $this->assertSame($plugin, $this->stub->getBaseName());
    }

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
