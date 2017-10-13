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
        $this->stub = $this->getMockForAbstractClass(
            AbstractPlugin::class,
            array(__FILE__)
        );
    }

    public function testGetFile()
    {
        $this->assertEquals(__FILE__, $this->stub->getFile());
    }

    public function testSetFile()
    {
        $this->assertEquals($this->stub, $this->stub->setFile(__FILE__));
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
        $this->assertEquals(plugin_dir_path(__FILE__), $this->stub->getDir());
    }

    public function testGetUrl()
    {
        $this->assertEquals(plugin_dir_url(__FILE__), $this->stub->getUrl());
    }
}
