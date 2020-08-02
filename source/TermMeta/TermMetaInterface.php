<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\TermMeta;

use Korobochkin\WPKit\DataComponents\NodeInterface;

/**
 * Interface TermMetaInterface
 *
 * Represent single term meta with non nested values.
 *
 * @package Korobochkin\WPKit\TermMeta
 */
interface TermMetaInterface extends NodeInterface
{

    /**
     * Retrieve value of node from WordPress DB.
     *
     * @throws \LogicException If name of post meta not setted up.
     *
     * @return string|bool|array String value of node if exists,
     * false if some cases (post meta not exists in DB) or array if post meta saved as array.
     */
    public function getValueFromWordPress();

    /**
     * Performs deletion of post meta only in DB.
     *
     * Delete post meta only in DB, local value (if presented) will still stored in this object.
     *
     * @throws \LogicException If name of post meta not setted up.
     *
     * @return bool Result of deletion.
     */
    public function deleteFromWP();

    /**
     * Performs pushing local value ($this->value) into the DB (actually save the value from instance
     * and remove $this->value because other code can use post meta directly
     * with get|update|delete_post_meta functions).
     *
     * @throws \LogicException If name of post meta not setted up.
     *
     * @return bool Result of pushing (saving) post meta in DB.
     */
    public function flush();

    /**
     * Set value to object and then immediately save it into the DB (call $this->flush()).
     *
     * If operation was unsuccessful then return false and don't delete local value.
     *
     * @param $value mixed Any type of value which can be passed to $this->setValue().
     *
     * @return bool Result of $this->flush() call.
     */
    public function updateValue($value);

    /**
     * Returns the post id of this post meta.
     *
     * @return int The post id.
     */
    public function getTermId();

    /**
     * Set the post id for this meta before doing any save-get value operations.
     *
     * @param $id int id of associated with this meta post.
     *
     * @return $this For chain calls.
     */
    public function setTermId($id);
}
