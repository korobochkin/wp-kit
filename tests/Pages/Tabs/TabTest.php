<?php
namespace Korobochkin\WPKit\Tests\Pages\Tabs;

use Korobochkin\WPKit\Pages\Tabs\Tab;

class TabTest extends \WP_UnitTestCase
{
    /**
     * @var Tab
     */
    protected $stub;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        parent::setUp();

        $this->stub = new Tab();
    }

    public function testGetterAndSetterName()
    {
        $this->assertNull($this->stub->getName());
        $this->assertSame($this->stub, $this->stub->setName('wp_kit_test_tab_name'));
        $this->assertSame('wp_kit_test_tab_name', $this->stub->getName());
    }

    public function testGetterAndSetterTitle()
    {
        $this->assertNull($this->stub->getTitle());
        $this->assertSame($this->stub, $this->stub->setTitle('Test Title'));
        $this->assertSame('Test Title', $this->stub->getTitle());
    }

    public function testGetterAndSetterUrl()
    {
        $this->assertNull($this->stub->getUrl());
        $this->assertSame(
            $this->stub,
            $this->stub->setUrl('http://example.org/wp-admin/admin.php?page=wp-kit-test-page')
        );
        $this->assertSame('http://example.org/wp-admin/admin.php?page=wp-kit-test-page', $this->stub->getUrl());
    }

    public function testGetterAndSetterActive()
    {
        $this->assertNull($this->stub->isActive());

        $this->assertSame($this->stub, $this->stub->markActive());
        $this->assertTrue($this->stub->isActive());

        $this->assertSame($this->stub, $this->stub->markUnActive());
        $this->assertFalse($this->stub->isActive());
    }
}
