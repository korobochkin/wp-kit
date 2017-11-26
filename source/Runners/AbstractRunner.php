<?php
namespace Korobochkin\WPKit\Runners;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AbstractRunner
 */
abstract class AbstractRunner implements RunnerInterface
{
    /**
     * @var ContainerInterface Container with services.
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
    public static function setContainer(ContainerInterface $container = null)
    {
        self::$container = $container;
    }
}
