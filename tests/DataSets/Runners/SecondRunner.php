<?php
namespace Korobochkin\WPKit\Tests\DataSets\Runners;

use Korobochkin\WPKit\Runners\ContainerTrait;
use Korobochkin\WPKit\Runners\RunnerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class SecondRunner
 */
class SecondRunner implements RunnerInterface
{
    use ContainerTrait;

    /**
     * @inheritdoc
     */
    public static function run()
    {
        return true;
    }
}
