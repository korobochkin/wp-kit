<?php
namespace Korobochkin\WPKit\Tests\DataSets;

/**
 * Class AbstractDataSet
 * @package Korobochkin\WPKit\Tests\DataSets
 */
abstract class AbstractDataSet implements \Iterator
{
    /**
     * @var array
     */
    protected $variants;

    /**
     * @var int
     */
    protected $position = 0;

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->variants[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->variants[$this->position]);
    }
}
