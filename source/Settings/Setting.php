<?php
namespace Korobochkin\WPKit\Settings;

use Korobochkin\WPKit\Options\OptionInterface;

/**
 * Class Setting
 * @package Korobochkin\WPKit\Settings
 */
class Setting implements SettingInterface
{
    /**
     * @var OptionInterface Option for this setting.
     */
    protected $option;

    /**
     * @var string Group name.
     */
    protected $group;

    /**
     * Setting constructor.
     *
     * @param OptionInterface $option
     */
    public function __construct(OptionInterface $option)
    {
        $this->option = $this->setOption($option);
    }

    /**
     * @inheritdoc
     */
    public function getOption()
    {
        return $this->getOption();
    }

    /**
     * @inheritdoc
     */
    public function setOption(OptionInterface $option)
    {
        $this->option = $option;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @inheritdoc
     */
    public function setGroup($group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function register()
    {
        $option = $this->getOption();
        if (isset($option)) {
            register_setting(
                $option->getGroup(),
                $option->getName(),
                array($option, '_sanitize')
            );
        }
    }

    /**
     * @inheritdoc
     */
    public function unRegister()
    {
        $option = $this->getOption();
        if (isset($option)) {
            unregister_setting($option->getGroup(), $option->getName());
        }
    }
}
