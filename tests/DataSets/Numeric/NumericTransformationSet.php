<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\DataSets\Numeric;

use Korobochkin\WPKit\Tests\DataSets\AbstractDataSet;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class NumericTransformationSet
 * @package Korobochkin\WPKit\Tests\DataSets\Numeric
 */
class NumericTransformationSet extends AbstractDataSet
{

    /**
     * TypesTransformationSet constructor.
     */
    public function __construct()
    {
        $variants = array(
            // @codingStandardsIgnoreStart
            array(true,        TransformationFailedException::class),
            array(false,       TransformationFailedException::class),

            array(1234,        (float) 1234),
            array(0,           (float) 0),
            array(-1234,       (float) -1234),
            //array(PHP_INT_MAX, TransformationFailedException::class), // this case throwing error but PHP 7 not catching it
            //array(PHP_INT_MIN, true),

            array(1.234,       1.234),
            array(1.2e3,       1.2e3),
            array(7E-10,       7E-10),
            array(-1.234,      -1.234),
            array(-1.2e3,      -1.2e3),
            array(-7E-10,      -7E-10),

            array('1',         (float) 1),
            array('VALUE',     TransformationFailedException::class),
            array('true',      TransformationFailedException::class),
            array('false',     TransformationFailedException::class),
            array('',          TransformationFailedException::class),
            array('0',         (float) 0),

            array(array(),     TransformationFailedException::class),
            array(array(1),    TransformationFailedException::class),
            array(array(1, 2), TransformationFailedException::class),
            array(array(''),   TransformationFailedException::class),
            array(array('1'),  TransformationFailedException::class),
            array(array('0'),  TransformationFailedException::class),

            array(new \stdClass(), TransformationFailedException::class),
            array(new \WP_Query(), TransformationFailedException::class),

            array(null,        null),
            // @codingStandardsIgnoreEnd
        );

        // @codingStandardsIgnoreStart
        // Only for PHP 7.
        // this case throwing error but PHP 7 not catching it
        /*$result = version_compare(phpversion(), '7');
        if($result == 0 || $result == 1) {
            $values[] = array(PHP_INT_MIN, TransformationFailedException::class);
        }*/
        // @codingStandardsIgnoreEnd

        $this->variants = $variants;
    }
}
