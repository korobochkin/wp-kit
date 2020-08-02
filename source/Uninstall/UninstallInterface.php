<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Uninstall;

/**
 * Interface UninstallInterface
 */
interface UninstallInterface
{
    /**
     * Runs all uninstall methods and removes everything.
     *
     * @throws \Exception If suppress exceptions is not enabled.
     *
     * @return $this For chain calls.
     */
    public function run();
}
