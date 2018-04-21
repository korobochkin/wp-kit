<?php
namespace Korobochkin\WPKit\Tests\DataSets;

/**
 * Class EverythingSet2
 *
 * WordPress has a mess with values (variables) types. Sometimes you save integer
 * but after retrieve it back you will get string. Or if you have Memcached server for WP your
 * integer value retrieved as integer, but if you disable Memcache then you get result as string.
 */
class EverythingSet2 extends AbstractAssociativeDataSet
{
    public function __construct()
    {
        $variants = array();

        $variants['1'] = array(
            null, // Value
            true, // Result of saving in WordPress (update_option())
            '',   // What WordPress returns after saving (get_option())
            true, // What WordPress returns after deleting (delete_option())
        );

        $variants['2'] = array(
            true,
            true,
            '1',
            true,
        );

        $variants['3'] = array(
            false,
            false,
            false,
            false,
        );

        $variants['4'] = array(
            1234,
            true,
            '1234',
            true,
        );

        $variants['5'] = array(
            0,
            true,
            '0',
            true,
        );

        $variants['6'] = array(
            -1234,
            true,
            '-1234',
            true,
        );

        $variants['7'] = array(
            PHP_INT_MAX,
            true,
            (string) PHP_INT_MAX,
            true,
        );

        if (PHP_VERSION_ID >= 70000) {
            $variants['7.2'] = array(
                PHP_INT_MIN,
                true,
                (string) PHP_INT_MIN,
                true,
            );
        }

        $variants['8'] = array(
            1.234,
            true,
            '1.234',
            true,
        );

        $variants['8.2'] = array(
            -1.234,
            true,
            '-1.234',
            true,
        );

        $variants['9'] = array(
            1.2e3,
            true,
            '1200',
            true,
        );

        $variants['9.2'] = array(
            -1.2e3,
            true,
            '-1200',
            true,
        );

        $variants['10'] = array(
            7E-10,
            true,
            '7.0E-10',
            true,
        );

        $variants['10.2 (PHP lower than 7)'] = array(
            -7E-10,
            true,
            '-7.0E-10',
            true,
        );

        $variants['11'] = array(
            '1',
            true,
            '1',
            true,
        );

        $variants['12'] = array(
            'VALUE',
            true,
            'VALUE',
            true,
        );

        $variants['13'] = array(
            'true',
            true,
            'true',
            true,
        );

        $variants['14'] = array(
            'false',
            true,
            'false',
            true,
        );

        $variants['15'] = array(
            '',
            true,
            '',
            true,
        );

        $variants['16'] = array(
            '0',
            true,
            '0',
            true,
        );

        $variants['17'] = array(
            array(),
            true,
            array(),
            true,
        );

        $variants['18'] = array(
            array(1),
            true,
            array(1),
            true,
        );

        $variants['19'] = array(
            array(1, 2),
            true,
            array(1, 2),
            true,
        );

        $variants['20'] = array(
            array(''),
            true,
            array(''),
            true,
        );

        $variants['21'] = array(
            array('1'),
            true,
            array('1'),
            true,
        );

        $variants['22'] = array(
            array('0'),
            true,
            array('0'),
            true,
        );

        $variants['23'] = array(
            new \stdClass(),
            true,
            new \stdClass(),
            true,
        );

        $variants['24'] = array(
            new \WP_Query(),
            true,
            new \WP_Query(),
            true,
        );

        $this->values = $variants;
    }
}
