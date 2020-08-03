<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Transients;

use Korobochkin\WPKit\DataComponents\NodeInterface;

/**
 * Interface TransientInterface
 *
 * Represent single transient with non nested values.
 *
 * @package Korobochkin\WPKit\Transients
 */
interface TransientInterface extends NodeInterface
{
    /**
     * Retrieve value of node from WordPress DB.
     *
     * @throws \LogicException If name of option not setted up.
     *
     * @return string|bool|array String value of node if exists,
     * false if some cases (transient not exists in DB) or array if option saved as array.
     */
    public function getValueFromWordPress();

    /**
     * Get current value of expiration.
     *
     * @return int Expiration in seconds.
     */
    public function getExpiration();

    /**
     * Set the expiration.
     *
     * @param int $expiration
     *
     * @return $this For chain calls.
     */
    public function setExpiration($expiration);

    /**
     * Performs deletion of transient only in DB.
     *
     * Delete transient only in DB, local value (if presented) will still stored in this object.
     *
     * @throws \LogicException If name of option not setted up.
     *
     * @return bool Result of deletion.
     */
    public function deleteFromWP();

    /**
     * Performs pushing local value ($this->value) into the DB (actually save the value from instance
     * and remove $this->value because other code can use transients directly
     * with get|update|delete_transient functions).
     *
     * @throws \LogicException If name of option not setted up.
     *
     * @return bool Result of pushing (saving) transient in DB.
     */
    public function flush();

    /**
     * Set value to object and then immediately save it into the DB (call $this->flush()).
     *
     * If operation was unsuccessful then return false and don't delete local value.
     *
     * @param $value mixed Any type of value which can be passed to $this->setValue().
     * @param integer $expiration The maximum of seconds to keep the data before refreshing.
     *
     * @return bool Result of $this->flush() call.
     */
    public function updateValue($value, $expiration = null);
}
