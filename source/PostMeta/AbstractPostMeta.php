<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\PostMeta;

use Korobochkin\WPKit\DataComponents\AbstractNode;
use Korobochkin\WPKit\DataComponents\Traits\DeleteTrait;
use Korobochkin\WPKit\DataComponents\Traits\PostIdTrait;
use Korobochkin\WPKit\DataComponents\Traits\PostMeta\GetNameWithVisibilityTrait;
use Korobochkin\WPKit\DataComponents\Traits\VisibilityTrait;

/**
 * Class AbstractPostMeta
 * @package Korobochkin\WPKit\PostMeta
 */
abstract class AbstractPostMeta extends AbstractNode implements PostMetaInterface
{
    use DeleteTrait;

    use PostIdTrait;

    use VisibilityTrait;

    use GetNameWithVisibilityTrait;

    /**
     * @inheritdoc
     */
    public function getValueFromWordPress()
    {
        $name = $this->getName();

        if (!$name) {
            throw new \LogicException(
                'You must specify the name of post meta before calling any methods using name of post meta.'
            );
        }

        $id = $this->getPostId();

        if (!$id) {
            throw new \LogicException(
                'You must specify the ID of post before calling any methods using ID of post.'
            );
        }

        $value = get_post_meta($id, $name, true);

        // If value is empty string this can means that value not exists at all.
        // This strange behaviour only for Post Meta (not Options or Transients).
        if ($value === '' || $value === array()) {
            if (!metadata_exists('post', $id, $name)) {
                return false;
            }
        }

        return $value;
    }

    /**
     * @inheritdoc
     */
    public function deleteFromWP()
    {
        $name = $this->getName();

        if (!$name) {
            throw new \LogicException(
                'You must specify the name of post meta before calling any methods using name of post meta.'
            );
        }

        $id = $this->getPostId();

        if (!$id) {
            throw new \LogicException(
                'You must specify the ID of post before calling any methods using ID of post.'
            );
        }

        return delete_post_meta($id, $name);
    }

    /**
     * @inheritdoc
     */
    public function flush()
    {
        if ($this->getDataTransformer()) {
            $raw = $this->getDataTransformer()->transform($this->localValue);
        } else {
            $raw =& $this->localValue;
        }

        $name = $this->getName();

        if (!$name) {
            throw new \LogicException(
                'You must specify the name of post meta before calling any methods using name of post meta.'
            );
        }

        $id = $this->getPostId();

        if (!$id) {
            throw new \LogicException(
                'You must specify the ID of post before calling any methods using ID of post.'
            );
        }

        // Do not save (bool) false values :)
        // since DataTransformer must convert it to '0' or other similar string.
        // This check needed to fully identity with Options and Transients.
        if ($raw === false) {
            return $raw;
        }

        $result = update_post_meta($id, $name, $raw);

        if ($result) {
            $this->setLocalValue(null);
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function updateValue($value)
    {
        $this->setLocalValue($value);

        return $this->flush();
    }
}
