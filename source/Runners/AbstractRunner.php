<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Runners;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AbstractRunner.
 *
 * WARNING: do not use this class to extend your own classes because all extended classes share
 * static self::$container variable with each other. This can breaks your or 3rd party code.
 *
 * @deprecated Do not use this class.
 */
abstract class AbstractRunner implements RunnerInterface
{
    /**
     * @var ContainerInterface Container with services.
     */
    protected static $container;

    /**
     * Returns the ContainerBuilder with services.
     *
     * @return ContainerInterface Container with services.
     */
    public static function getContainer()
    {
        return self::$container;
    }

    /**
     * Sets the ContainerBuilder with services.
     *
     * @param ContainerInterface $container Container with services.
     */
    public static function setContainer(ContainerInterface $container = null)
    {
        self::$container = $container;
    }
}
