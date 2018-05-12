<?php
namespace Korobochkin\WPKit\Tests\DataSets;

/**
 * Class EverythingSet
 * @package Korobochkin\WPKit\Tests\DataSets
 */
class EverythingSet extends AbstractDataSet
{
    public function __construct()
    {
        $variants = array(
            // @codingStandardsIgnoreStart
            //   |$value          |$expectedResultOfSavingOrDeletion  |$expectedValueFromWP      |
            //   |Initial value   |Result of saving in WP             |Value after saving        |
            //   |Local value     |or result of deletion              |which will return WP      |
            //   |                |                                   |                          |
            array(NULL,            true,                               '',                        ), // 0
            array(true,            true,                               true,                      ), // 1
            array(false,           false,                              false,                     ), // 2

            array(1234,            true,                               '1234'                     ), // 3
            array(0,               true,                               '0'                        ), // 4
            array(-1234,           true,                               '-1234'                    ), // 5
            array(PHP_INT_MAX,     true,                               (string)PHP_INT_MAX        ), // 6

            array(1.234,           true,                               '1.234'                    ), // 7
            array(1.2e3,           true,                               '1.2e3'                    ), // 8
            array(7E-10,           true,                               '7E-10'                    ), // 9
            array(-1.234,          true,                               '-1.234'                   ), // 10
            array(-1.2e3,          true,                               '-1.2e3'                   ), // 11
            array(-7E-10,          true,                               '-7E-10'                   ), // 12

            array('1',             true,                               '1'                        ), // 13
            array('VALUE',         true,                               'VALUE'                    ), // 14
            array('true',          true,                               'true'                     ), // 15
            array('false',         true,                               'false'                    ), // 16
            array('',              true,                               ''                         ), // 17
            array('0',             true,                               '0'                        ), // 18

            array(array(),         true,                               array()                    ), // 19
            array(array(1),        true,                               array(1)                   ), // 20
            array(array(1, 2),     true,                               array(1, 2)                ), // 21
            array(array(''),       true,                               array('')                  ), // 22
            array(array('1'),      true,                               array('1')                 ), // 23
            array(array('0'),      true,                               array('0')                 ), // 24

            array(new \stdClass(), true,                               new \stdClass()            ), // 25
            array(new \WP_Query(), true,                               new \WP_Query()            ), // 26
            // @codingStandardsIgnoreEnd
        );

        // Only for PHP 7.
        if (PHP_VERSION_ID >= 70000) {
            // 27.
            $variants[] = array(PHP_INT_MIN, true, (string) PHP_INT_MIN);
        }

        $this->variants = $variants;
        $this->position = 0;
    }
}
