<?php
namespace Korobockin\WPKit\Pages\Traits;

trait Name
{
    /**
     * @var string
     */
    protected $name;

    /***
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name string Name.
     *
     * @return $this For chain calls.
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
