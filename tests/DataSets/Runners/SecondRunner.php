<?php
namespace Korobochkin\WPKit\Tests\DataSets\Runners;

use Korobochkin\WPKit\Runners\AbstractRunner;

/**
 * Class SecondRunner
 */
class SecondRunner extends AbstractRunner
{
    /**
     * @inheritdoc
     */
    public static function run()
    {
        return true;
    }
}
