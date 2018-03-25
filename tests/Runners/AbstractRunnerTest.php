<?php
namespace Korobochkin\WPKit\Tests\Runners;

use Korobochkin\WPKit\Runners\AbstractRunner;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AbstractRunnerTest
 */
class AbstractRunnerTest extends \WP_UnitTestCase
{
    /**
     * @var AbstractRunner
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForAbstractClass(AbstractRunner::class);
    }

    public function testGetterAndSetter()
    {
        $stub = $this->stub;
        $this->assertNull($stub::getContainer());

        $containerBuilder = new ContainerBuilder();
        $this->assertNull($stub::setContainer($containerBuilder));

        $this->assertSame($containerBuilder, $stub::getContainer());
    }
}
