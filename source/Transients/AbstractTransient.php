<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Transients;

use Korobochkin\WPKit\DataComponents\AbstractNode;
use Korobochkin\WPKit\DataComponents\Traits\DeleteTrait;
use Korobochkin\WPKit\DataComponents\Traits\ExpirationTrait;

/**
 * Class AbstractTransient
 * @package Korobochkin\WPKit\Transients
 */
abstract class AbstractTransient extends AbstractNode implements TransientInterface
{
    use DeleteTrait;

    use ExpirationTrait;

    /**
     * @inheritdoc
     */
    public function getValueFromWordPress()
    {
        $name = $this->getName();

        if (!$name) {
            throw new \LogicException(
                'You must specify the name of transient before calling any methods using name of transient.'
            );
        }

        return get_transient($name);
    }

    /**
     * @inheritdoc
     */
    public function deleteFromWP()
    {
        $name = $this->getName();

        if (!$name) {
            throw new \LogicException(
                'You must specify the name of transient before calling any methods using name of transient.'
            );
        }

        return delete_transient($name);
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
                'You must specify the name of transient before calling any methods using name of transient.'
            );
        }

        $result = set_transient($name, $raw, $this->getExpiration());

        if ($result) {
            $this->setLocalValue(null);
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function updateValue($value, $expiration = null)
    {
        $this->setLocalValue($value);

        if (!is_null($expiration)) {
            $this->setExpiration($expiration);
        }

        return $this->flush();
    }
}
