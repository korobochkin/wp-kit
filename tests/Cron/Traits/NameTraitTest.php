<?php
namespace Korobochkin\WPKit\Tests\Cron\Traits;

use Korobochkin\WPKit\Cron\Traits\NameTrait;

/**
 * Class NameTraitTest
 * @package Korobochkin\WPKit\Tests\Cron\Traits
 */
class NameTraitTest extends \WP_UnitTestCase
{
    /**
     * @var NameTrait
     */
    protected $stub;

    /**
     * Prepare stub for tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForTrait(NameTrait::class);
    }

    public function testStub()
    {
        $defaultValue = null;

        $this->assertSame($defaultValue, $this->stub->getName());

        $value = 'wp_kit_test_name';

        $this->assertSame($this->stub, $this->stub->setName($value));

        $this->assertSame($value, $this->stub->getName());
    }
}
