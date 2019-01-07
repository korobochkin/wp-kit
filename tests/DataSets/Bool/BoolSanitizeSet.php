<?php
namespace Korobochkin\WPKit\Tests\DataSets\Bool;

use Korobochkin\WPKit\Tests\DataSets\AbstractDataSet;

class BoolSanitizeSet extends AbstractDataSet
{
    public function __construct()
    {
        $this->variants = array(
            array(null,            false),
            array(true,            true),
            array(false,           false),
            array(1234,            true),
            array(0,               false),
            array(-1234,           true),
            array(PHP_INT_MAX,     true),
            array(1.234,           true),
            array(1.2e3,           true),
            array(7E-10,           true),
            array(-1.234,          true),
            array(-1.2e3,          true),
            array(-7E-10,          true),
            array('1',             true),
            array('VALUE',         true),
            array('true',          true),
            array('false',         true),
            array('',              false),
            array('0',             false),
            array(array(),         false),
            array(array(1),        true),
            array(array(1, 2),     true),
            array(array(''),       true),
            array(array('1'),      true),
            array(array('0'),      true),
            array(new \stdClass(), true),
            array(new \WP_Query(), true),
        );

        if (PHP_VERSION_ID >= 70000) {
            $this->variants[] = array(PHP_INT_MIN, true);
        }
    }
}
