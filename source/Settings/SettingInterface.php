<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Settings;

use Korobochkin\WPKit\Options\OptionInterface;

interface SettingInterface
{
    /**
     * Returns option instance for this setting.
     *
     * @return OptionInterface Option for this setting.
     */
    public function getOption();

    /**
     * Set option for this setting.
     *
     * @param OptionInterface $option
     *
     * @return $this For chain calls.
     */
    public function setOption(OptionInterface $option);

    /**
     * Returns group name which can be used on settings pages.
     *
     * @return string Option group name.
     */
    public function getGroup();

    /**
     * Setup option group name for settings pages.
     *
     * @param $group string Option group name.
     *
     * @return $this For chain calls.
     */
    public function setGroup($group);

    /**
     * Register option like a setting for WordPress admin settings pages.
     */
    public function register();

    /**
     * Unregister option from WordPress admin settings pages.
     */
    public function unRegister();
}
