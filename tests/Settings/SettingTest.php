<?php
namespace Korobochkin\WPKit\Tests\Settings;

use Korobochkin\WPKit\Options\Option;
use Korobochkin\WPKit\Settings\Setting;

class SettingTest extends \WP_UnitTestCase
{
    /**
     * @var Setting
     */
    protected $stub;

    function setUp()
    {
        parent::setUp();
        $option = new Option();
        $option->setName('wp_kit_test_option');
        $this->stub = new Setting($option);
    }

    public function testConstruct()
    {
        $option = new Option();
        $stub = new Setting($option);
        $this->assertSame($option, $stub->getOption());
    }

    public function testGetterAndSetterOption()
    {
        $option = new Option();
        $this->assertSame($this->stub, $this->stub->setOption($option));
        $this->assertSame($option, $this->stub->getOption());
    }

    public function testGetterAndSetterGroup()
    {
        $value = 'wp_kit_test_group_name';
        $this->assertNull($this->stub->getGroup());
        $this->assertSame($this->stub, $this->stub->setGroup($value));
        $this->assertSame($value, $this->stub->getGroup());
    }

    public function testRegisterWithoutOption()
    {
        $this->stub->setOption(null);
        $this->setExpectedException(\LogicException::class, 'Set option before call register method.');
        $this->stub->register();
    }

    public function testRegister()
    {
        $this->stub->setGroup('wp_kit_test_register_group_name');
        $this->assertSame($this->stub, $this->stub->register());

        $expected = array(
            'type'              => 'string',
            'group'             => 'wp_kit_test_register_group_name',
            'description'       => '',
            'sanitize_callback' => null,
            'show_in_rest'      => false,
        );

        global $wp_registered_settings;
        $this->assertArrayHasKey('wp_kit_test_option', $wp_registered_settings);
        $this->assertSame($expected, $wp_registered_settings['wp_kit_test_option']);
    }

    public function testUnRegisterWithoutOption()
    {
        $this->stub->setOption(null);
        $this->setExpectedException(\LogicException::class, 'Set option before call register method.');
        $this->stub->unRegister();
    }

    public function testUnRegister()
    {
        $this->stub->setGroup('wp_kit_test_unregister_group_name');
        $this->assertSame($this->stub, $this->stub->register()->unRegister());

        global $wp_registered_settings;
        $this->assertArrayNotHasKey('wp_kit_test_unregister_group_name', $wp_registered_settings);
    }
}
