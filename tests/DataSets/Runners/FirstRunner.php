<?php
namespace Korobochkin\WPKit\Tests\DataSets\Runners;

use Korobochkin\WPKit\Runners\AbstractRunner;

/**
 * Class FirstRunner
 */
class FirstRunner extends AbstractRunner
{
    /**
     * @inheritdoc
     */
    public static function run()
    {
        return true;
    }
}
