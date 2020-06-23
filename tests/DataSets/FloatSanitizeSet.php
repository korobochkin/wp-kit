<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\DataSets;

class FloatSanitizeSet extends AbstractDataSet
{
    public function __construct()
    {
        $this->variants = array(
            array(null,            0.0),
            array(true,            1.0),
            array(false,           0.0),
            array(1234,            1234.0),
            array(0,               0.0),
            array(-1234,           -1234.0),
            array(PHP_INT_MAX,     (float) PHP_INT_MAX),
            array(1.234,           1.234),
            array(1.2e3,           1.2e3),
            array(7E-10,           (float) 7E-10),
            array(-1.234,          -1.234),
            array(-1.2e3,          -1.2e3),
            array(-7E-10,          (float) -7E-10),
            array('1',             1.0),
            array('VALUE',         0.0),
            array('true',          0.0),
            array('false',         0.0),
            array('',              0.0),
            array('0',             0.0),
            array(array(),         0.0),
            array(array(1),        1.0),
            array(array(1, 2),     1.0),
            array(array(''),       1.0),
            array(array('1'),      1.0),
            array(array('0'),      1.0),
            array(new \stdClass(), 1.0),
            array(new \WP_Query(), 1.0),
        );

        if (PHP_VERSION_ID >= 70000) {
            $this->variants[] = array(PHP_INT_MIN, (float) PHP_INT_MIN);
        }
    }
}
