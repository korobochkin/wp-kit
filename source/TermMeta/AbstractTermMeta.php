<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\TermMeta;

use Korobochkin\WPKit\DataComponents\AbstractNode;
use Korobochkin\WPKit\DataComponents\Traits\DeleteTrait;
use Korobochkin\WPKit\DataComponents\Traits\TermIdTrait;

/**
 * Class AbstractTermMeta
 * @package Korobochkin\WPKit\TermMeta
 */
abstract class AbstractTermMeta extends AbstractNode implements TermMetaInterface
{
    use DeleteTrait;

    use TermIdTrait;

    /**
     * @inheritdoc
     */
    public function getValueFromWordPress()
    {
        $name = $this->getName();

        if (!$name) {
            throw new \LogicException(
                'You must specify the name of term meta before calling any methods using name of term meta.'
            );
        }

        $id = $this->getTermId();

        if (!$id) {
            throw new \LogicException(
                'You must specify the ID of term before calling any methods using ID of term.'
            );
        }

        $value = get_term_meta($id, $name, true);

        // If value is empty string this can means that value not exists at all.
        // This strange behaviour peculiar only for Post Meta (not Options or Transients).
        if ($value === '' && ! metadata_exists('term', $id, $name)) {
            return false;
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
                'You must specify the name of term meta before calling any methods using name of term meta.'
            );
        }

        $id = $this->getTermId();

        if (!$id) {
            throw new \LogicException(
                'You must specify the ID of term before calling any methods using ID of term.'
            );
        }

        return delete_term_meta($id, $name);
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
                'You must specify the name of term meta before calling any methods using name of term meta.'
            );
        }

        $id = $this->getTermId();

        if (!$id) {
            throw new \LogicException(
                'You must specify the ID of term before calling any methods using ID of term.'
            );
        }

        // Do not save (bool) false values :)
        // since DataTransformer must convert it to '0' or other similar string.
        // This check needed to fully identity with Options and Transients.
        if ($raw === false) {
            return $raw;
        }

        $result = update_term_meta($id, $name, $raw);

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
