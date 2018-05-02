<?php
namespace Korobochkin\WPKit\Tests\Cron\Traits;

use Korobochkin\WPKit\Cron\Traits\TimestampTrait;

/**
 * Class TimestampTraitTest
 * @package Korobochkin\WPKit\Tests\Cron\Traits
 */
class TimestampTraitTest extends \WP_UnitTestCase
{
    /**
     * @var TimestampTrait
     */
    protected $stub;

    /**
     * Prepare stub for tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForTrait(TimestampTrait::class);
    }

    public function testStub()
    {
        $defaultValue = 1;

        $this->assertSame($defaultValue, $this->stub->getTimestamp());

        $value = time();

        $this->assertSame($this->stub, $this->stub->setTimestamp($value));

        $this->assertSame($value, $this->stub->getTimestamp());
    }
}
