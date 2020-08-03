<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Settings;

use Korobochkin\WPKit\Options\OptionInterface;
use Korobochkin\WPKit\Utils\Compatibility;

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
        $this->option = $option;
    }

    /**
     * @inheritdoc
     */
    public function getOption()
    {
        return $this->option;
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
        if (!isset($this->option)) {
            throw new \LogicException('Set option before call register method.');
        }

        register_setting(
            $this->getGroup(),
            $this->option->getName(),
            array($this->option, 'sanitize')
        );

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function unRegister()
    {
        if (!isset($this->option)) {
            throw new \LogicException('Set option before call unRegister method.');
        }

        if (!Compatibility::checkWordPress('4.7')) {
            unregister_setting($this->getGroup(), $this->option->getName(), array($this->option, 'sanitize'));
        } else {
            unregister_setting($this->getGroup(), $this->option->getName());
        }

        return $this;
    }
}
