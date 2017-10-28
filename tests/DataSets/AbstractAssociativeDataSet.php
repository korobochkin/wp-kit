<?php
namespace Korobochkin\WPKit\Tests\DataSets;

/**
 * Class AbstractAssociativeDataSet
 */
class AbstractAssociativeDataSet implements \Iterator
{
    /**
     * @var array Values.
     */
    protected $values;

    /**
     * @inheritdoc
     */
    public function rewind()
    {
        reset($this->values);
    }

    /**
     * @inheritdoc
     */
    public function current()
    {
        return current($this->values);
    }

    /**
     * @inheritdoc
     */
    public function key()
    {
        return key($this->values);
    }

    /**
     * @inheritdoc
     */
    public function next()
    {
        next($this->values);
    }

    /**
     * @inheritdoc
     */
    public function valid()
    {
        return isset($this->values[$this->key()]);
    }
}
