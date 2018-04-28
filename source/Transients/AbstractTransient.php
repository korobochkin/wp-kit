<?php
namespace Korobochkin\WPKit\Transients;

use Korobochkin\WPKit\DataComponents\AbstractNode;
use Korobochkin\WPKit\DataComponents\Traits\DeleteTrait;

/**
 * Class AbstractTransient
 * @package Korobochkin\WPKit\Transients
 */
abstract class AbstractTransient extends AbstractNode implements TransientInterface
{
    use DeleteTrait;

    /**
     * @var $expiration int Expiration of transient.
     */
    protected $expiration = 1;

    /**
     * @inheritdoc
     */
    public function getValueFromWordPress()
    {
        $name = $this->getName();

        if (!$name) {
            throw new \LogicException(
                'You must specify the name of option before calling any methods using name of option.'
            );
        }

        return get_transient($name);
    }

    public function doIt()
    {
    }

    /**
     * @inheritdoc
     */
    public function getExpiration()
    {
        return $this->expiration;
    }

    /**
     * @inheritdoc
     */
    public function setExpiration($expiration)
    {
        $this->expiration = $expiration;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function deleteFromWP()
    {
        $name = $this->getName();

        if (!$name) {
            throw new \LogicException(
                'You must specify the name of option before calling any methods using name of option.'
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
                'You must specify the name of option before calling any methods using name of option.'
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
