<?php
namespace Korobochkin\WPKit\Tests\DataSets;

class IntegerSanitizeSet extends AbstractDataSet
{
    public function __construct()
    {
        $this->variants = array(
            array(null,            0),
            array(true,            1),
            array(false,           0),
            array(1234,            1234),
            array(0,               0),
            array(-1234,           -1234),
            array(PHP_INT_MAX,     PHP_INT_MAX),
            array(1.234,           1),
            array(1.2e3,           1200),
            array(7E-10,           0),
            array(-1.234,          -1),
            array(-1.2e3,          -1200),
            array(-7E-10,          0),
            array('1',             1),
            array('VALUE',         0),
            array('true',          0),
            array('false',         0),
            array('',              0),
            array('0',             0),
            array(array(),         0),
            array(array(1),        1),
            array(array(1, 2),     1),
            array(array(''),       1),
            array(array('1'),      1),
            array(array('0'),      1),
            array(new \stdClass(), 1),
            array(new \WP_Query(), 1),
        );

        if (PHP_VERSION_ID >= 70000) {
            $this->variants[] = array(PHP_INT_MIN, PHP_INT_MIN);
        }
    }
}
