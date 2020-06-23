<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Utils;

/**
 * Class CronUtils
 */
class CronUtils
{
    /**
     * Unschedules all events attached to the hook.
     *
     * Can be useful for plugins when deactivating to clean up the cron queue.
     *
     * @see wp_unschedule_hook
     *
     * @param string $hook Action hook, the execution of which will be unscheduled.
     */
    public static function unscheduleHook($hook)
    {
        // WordPress >= 4.9.0
        if (function_exists('wp_unschedule_hook')) {
            wp_unschedule_hook($hook);
            return;
        }

        // For previous WordPress versions

        $crons = _get_cron_array();

        foreach ($crons as $timestamp => $args) {
            unset($crons[$timestamp][$hook]);

            if (empty($crons[$timestamp])) {
                unset($crons[$timestamp]);
            }
        }

        _set_cron_array($crons);
    }
}
