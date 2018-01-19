<?php
namespace Korobochkin\WPKit\Tests\DataSets\Runners;

use Korobochkin\WPKit\Runners\ContainerTrait;
use Korobochkin\WPKit\Runners\RunnerInterface;

/**
 * Class FirstRunner
 */
class FirstRunner implements RunnerInterface
{
    use ContainerTrait;

    /**
     * @var ContainerInterface Container with services.
     */
    protected static $container;

    /**
     * @inheritdoc
     */
    public static function run()
    {
        return true;
    }
}
