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
     * @inheritdoc
     */
    public static function run()
    {
        return true;
    }
}
