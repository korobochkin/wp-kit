<?php
namespace Korobochkin\WPKit\Tests\MetaBoxes;

use Korobochkin\WPKit\MetaBoxes\MetaBox;
use Korobochkin\WPKit\MetaBoxes\MetaBoxStack;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Class MetaBoxStackTest
 */
class MetaBoxStackTest extends \WP_UnitTestCase
{
    public function testGetterAndSetterMetaBoxes()
    {
        $stub = new MetaBoxStack();

        $this->assertEquals(array(), $stub->getMetaBoxes());

        $value = array(
            new MetaBox(),
            new MetaBox(),
        );

        $this->assertEquals($stub, $stub->setMetaBoxes($value));
        $this->assertEquals($value, $stub->getMetaBoxes());

        $value[] = new MetaBox();

        $this->assertEquals($stub, $stub->addMetaBox($value[2]));
        $this->assertEquals($value, $stub->getMetaBoxes());
    }

    public function testInitialize()
    {
        $stub = new MetaBoxStack();
        $this->assertEquals($stub, $stub->initialize());
    }

    public function testRegister()
    {
        $stub = new MetaBoxStack();

        $metaBox = new MetaBox();
        $metaBox
            ->setId('wp_kit_test_1')
            ->setTitle('Test Title')
            ->setScreen(\WP_Screen::get('post'))
            ->setContext('side');

        $stub->addMetaBox($metaBox);

        $metaBox = new MetaBox();
        $metaBox
            ->setId('wp_kit_test_2')
            ->setTitle('Test Title 2')
            ->setScreen(\WP_Screen::get('post'))
            ->setContext('side');

        $stub->addMetaBox($metaBox);

        $this->assertEquals($stub, $stub->register());
    }

    public function testSetContainer()
    {
        $stub = new MetaBoxStack();

        $container = new ContainerBuilder();
        $this->assertEquals($stub, $stub->setContainer($container));
    }

    public function testGet()
    {
        $stub      = new MetaBoxStack();
        $container = new ContainerBuilder();
        $stub->setContainer($container);

        $container->register('wp_kit_test', \stdClass::class);
        $this->assertInstanceOf(\stdClass::class, $stub->get('wp_kit_test'));

        $this->setExpectedException(ServiceNotFoundException::class);

        $stub->get('wp_kit_test_unknown');
    }
}
