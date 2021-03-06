<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Cron\Traits;

use Korobochkin\WPKit\Cron\Traits\HookTrait;

/**
 * Class HookTraitTest
 * @package Korobochkin\WPKit\Tests\Cron\Traits
 */
class HookTraitTest extends \WP_UnitTestCase
{
    /**
     * @var HookTrait
     */
    protected $stub;

    /**
     * Prepare stub for tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForTrait(HookTrait::class);
    }

    public function testStub()
    {
        $defaultValue = 'execute';

        $this->assertSame($defaultValue, $this->stub->getHook());

        $value = 'custom_callback';

        $this->assertSame($this->stub, $this->stub->setHook($value));

        $this->assertSame($value, $this->stub->getHook());
    }
}
