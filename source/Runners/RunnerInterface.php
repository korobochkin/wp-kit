<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Runners;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Interface RunnerInterface can be used for actions and filters.
 *
 * In pare with Container builder and WordPress actions or filters
 * the Runners can get the required service and run it.
 *
 * This technic allows to deal witn class instances in WordPress static world.
 *
 * Write services that not depends on Container itself
 * but developers also able to use classic static WordPress add_action and
 * add_filters functions to attach their runners.
 */
interface RunnerInterface
{
    /**
     * Returns the ContainerBuilder with services.
     *
     * @return ContainerInterface Container with services.
     */
    public static function getContainer();

    /**
     * Sets the ContainerBuilder with services.
     *
     * @param ContainerInterface $container Container with services.
     */
    public static function setContainer(ContainerInterface $container = null);

    /**
     * Should run desired service.
     *
     * This method usually should have only few lines of code to accomplish
     * two single actions.
     * 1. Get the service from ContainerInterface.
     * 2. Run the service (call any method from it).
     */
    public static function run();
}
