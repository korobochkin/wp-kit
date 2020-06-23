<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Cron\Traits;

use Korobochkin\WPKit\Cron\Traits\ArgsTrait;

/**
 * Class ArgsTraitTest
 * @package Korobochkin\WPKit\Tests\Cron\Traits
 */
class ArgsTraitTest extends \WP_UnitTestCase
{
    /**
     * @var ArgsTrait
     */
    protected $stub;

    /**
     * Prepare stub for tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForTrait(ArgsTrait::class);
    }

    public function testStub()
    {
        $defaultValue = array();

        $this->assertSame($defaultValue, $this->stub->getArgs());

        $value = array(1, 2, 3);

        $this->assertSame($this->stub, $this->stub->setArgs($value));

        $this->assertSame($value, $this->stub->getArgs());
    }
}
