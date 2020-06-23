<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Cron\Traits;

use Korobochkin\WPKit\Cron\Traits\RecurrenceTrait;

/**
 * Class RecurrenceTraitTest
 * @package Korobochkin\WPKit\Tests\Cron\Traits
 */
class RecurrenceTraitTest extends \WP_UnitTestCase
{
    /**
     * @var RecurrenceTrait
     */
    protected $stub;

    /**
     * Prepare stub for tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForTrait(RecurrenceTrait::class);
    }

    public function testStub()
    {
        $defaultValue = 'hourly';

        $this->assertSame($defaultValue, $this->stub->getRecurrence());

        $value = 'daily';

        $this->assertSame($this->stub, $this->stub->setRecurrence($value));

        $this->assertSame($value, $this->stub->getRecurrence());
    }
}
