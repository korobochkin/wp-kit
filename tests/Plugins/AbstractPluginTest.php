<?php
namespace Korobochkin\WPKit\Tests\Plugins;

use Korobochkin\WPKit\Plugins\AbstractPlugin;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AbstractPluginTest
 */
class AbstractPluginTest extends \WP_UnitTestCase
{
    /**
     * @var AbstractPlugin
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForAbstractClass(
            AbstractPlugin::class,
            array(__FILE__)
        );
    }

    public function testRunAdmin()
    {
        $this->assertSame($this->stub, $this->stub->runAdmin());
    }

    public function testGetFile()
    {
        $this->assertSame(__FILE__, $this->stub->getFile());
    }

    public function testSetFile()
    {
        $this->assertSame($this->stub, $this->stub->setFile(__FILE__));
    }

    public function testGetContainer()
    {
        $this->assertNull($this->stub->getContainer());

        $this->stub->setContainer(new ContainerBuilder());
    }

    public function testSetContainer()
    {
        $container = new ContainerBuilder();
        $this->assertSame($this->stub, $this->stub->setContainer($container));
        $this->assertSame($container, $this->stub->getContainer());
    }

    public function testGetDir()
    {
        $this->assertSame(plugin_dir_path(__FILE__), $this->stub->getDir());
    }

    public function testGetUrl()
    {
        $this->assertSame(plugin_dir_url(__FILE__), $this->stub->getUrl());
    }

    /**
     * @dataProvider casesGetBasename
     *
     * @param $plugin string Plugin path.
     */
    public function testGetBasename($plugin)
    {
        $this->stub->setFile(path_join(WP_PLUGIN_DIR, 'hello.php'));

        $this->assertSame($plugin, $this->stub->getBaseName());
    }

    public function casesGetBasename()
    {
        return array(
            array(
                'hello.php',
                'akismet/akismet.php',
            ),
        );
    }
}
