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
        $variants = array(
            '1' => array(
                NULL, // Value
                true, // Result of saving in WordPress
                '',   // What WordPress returns after saving
                true, // What WordPress returns after deleting
            ),
            '2' => array(
                true,
                true,
                true,
                true,
            ),
            '3' => array(
                false,
                false,
                false,
                false,
            ),
            '4' => array(
                1234,
                true,
                '1234',
                true,
            ),
            '5' => array(
                0,
                true,
                '0',
                true,
            ),
            '6' => array(
                -1234,
                true,
                '-1234',
                true,
            ),
            '7' => array(
                PHP_INT_MAX,
                true,
                (string)PHP_INT_MAX,
                true,
            ),
            '8' => array(
                1.234,
                true,
                '1.234',
                true,
            ),
            '8.2' => array(
                -1.234,
                true,
                '-1.234',
                true,
            ),
            '9' => array(
                1.2e3,
                true,
                '1.2e3',
                true,
            ),
            '9.2' => array(
                -1.2e3,
                true,
                '-1.2e3',
                true,
            ),
            '10' => array(
                7E-10,
                true,
                '7E-10',
                true,
            ),
            '10.2' => array(
                -7E-10,
                true,
                '-7E-10',
                true,
            ),
            '11' => array(
                '1',
                true,
                '1',
                true,
            ),
            '12' => array(
                'VALUE',
                true,
                'VALUE',
                true,
            ),
            '13' => array(
                'true',
                true,
                'true',
                true,
            ),
            '14' => array(
                'false',
                true,
                'false',
                true,
            ),
            '15' => array(
                '',
                true,
                '',
                true,
            ),
            '16' => array(
                '0',
                true,
                '0',
                true,
            ),
            '17' => array(
                array(),
                true,
                array(),
                true,
            ),
            '18' => array(
                array(1),
                true,
                array(1),
                true,
            ),
            '19' => array(
                array(1, 2),
                true,
                array(1, 2),
                true,
            ),
            '20' => array(
                array(''),
                true,
                array(''),
                true,
            ),
            '21' => array(
                array('1'),
                true,
                array('1'),
                true,
            ),
            '22' => array(
                array('0'),
                true,
                array('0'),
                true,
            ),
            '23' => array(
                $std = new \stdClass(),
                true,
                $std,
                true,
            ),
            '24' => array(
                $query = new \WP_Query(),
                true,
                $query,
                true,
            ),
        );

        // Only for PHP 7.
        if (PHP_VERSION_ID >= 70000) {
            $variants['7.2'] = array(
                PHP_INT_MIN,
                true, (string)
                PHP_INT_MIN,
                true,
            );
        }

        $this->values = $variants;
    }
}
