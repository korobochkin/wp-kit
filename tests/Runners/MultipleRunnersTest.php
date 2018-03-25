<?php
namespace Korobochkin\WPKit\Tests\Runners;

use Korobochkin\WPKit\Tests\DataSets\Runners\FirstRunner;
use Korobochkin\WPKit\Tests\DataSets\Runners\SecondRunner;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class MultipleRunnersTest
 */
class MultipleRunnersTest extends \WP_UnitTestCase
{

    /**
     * This test check that different runners can handle
     * and store different container instances.
     */
    public function testMultipleRunners()
    {
        $firstContainer = new ContainerBuilder();
        $firstContainer->setParameter('test_param', 'test/value');

        $this->assertNotEquals(FirstRunner::class, SecondRunner::class);

        $this->assertEmpty(FirstRunner::getContainer());
        FirstRunner::setContainer($firstContainer);
        $this->assertSame($firstContainer, FirstRunner::getContainer());
        $this->assertEmpty(SecondRunner::getContainer());

        FirstRunner::setContainer(null);
        $this->assertEmpty(FirstRunner::getContainer());

        $secondContainer = new ContainerBuilder();

        $this->assertEmpty(SecondRunner::getContainer());
        SecondRunner::setContainer($secondContainer);
        $this->assertSame($secondContainer, SecondRunner::getContainer());
        $this->assertEmpty(FirstRunner::getContainer());

        SecondRunner::setContainer(null);
        $this->assertEmpty(SecondRunner::getContainer());

        $this->assertNotEquals($firstContainer, $secondContainer);

        $thirdContainer = new ContainerBuilder();
        $this->assertNotEquals($firstContainer, $thirdContainer);
        $this->assertSame($secondContainer, $thirdContainer);
    }
}
