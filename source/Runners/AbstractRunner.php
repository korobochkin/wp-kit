<?php
namespace Korobochkin\WPKit\Runners;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AbstractRunner
 */
abstract class AbstractRunner implements RunnerInterface
{
    /**
     * @var ContainerBuilder Container with services.
     */
    protected static $container;

    /**
     * @inheritdoc
     */
    public static function getContainer()
    {
        return self::$container;
    }

    /**
     * @inheritdoc
     */
    public static function setContainer(ContainerBuilder $container)
    {
        self::$container = $container;
    }
}
