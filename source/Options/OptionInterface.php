<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Options;

use Korobochkin\WPKit\DataComponents\NodeInterface;

/**
 * Interface OptionInterface
 *
 * Represent single option with non nested values.
 *
 * @package Korobochkin\WPKit\Options
 */
interface OptionInterface extends NodeInterface
{
    /**
     * Retrieve value of node from WordPress DB.
     *
     * @throws \LogicException If name of option not setted up.
     *
     * @return string|bool|array String value of node if exists,
     * false if some cases (option not exists in DB) or array if option saved as array.
     */
    public function getValueFromWordPress();

    /**
     * Describes if this option should be autoloaded by WordPress or not.
     *
     * @return bool true if it autoloaded, false otherwise.
     */
    public function isAutoload();

    /**
     * Setup how this option should be loaded. This setting not effects immediately. You need call $this->updateValue()
     * or $this->flush() to persist changes.
     *
     * @param $autoload bool True for autoload, false for disable autoload.
     *
     * @return $this For chain calls.
     */
    public function setAutoload($autoload);

    /**
     * Performs deletion of option only in DB.
     *
     * Delete option only in DB, local value (if presented) will still stored in this object.
     *
     * @throws \LogicException If name of option not setted up.
     *
     * @return bool Result of deletion.
     */
    public function deleteFromWP();

    /**
     * Performs pushing local value ($this->value) into the DB (actually save the value from instance
     * and remove $this->value because other code can use options directly with get|update|delete_option functions).
     *
     * @throws \LogicException If name of option not setted up.
     *
     * @return bool Result of pushing (saving) option in DB.
     */
    public function flush();

    /**
     * Set value to object and then immediately save it into the DB (call $this->flush()).
     *
     * If operation was unsuccessful then return false and don't delete local value.
     *
     * @param $value mixed Any type of value which can be passed to $this->setValue().
     * @param null|bool $autoload This value passed to $this->setAutoload()
     *
     * @return bool Result of $this->flush() call.
     */
    public function updateValue($value, $autoload = null);
}
