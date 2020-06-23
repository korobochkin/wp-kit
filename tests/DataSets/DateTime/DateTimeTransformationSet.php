<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\DataSets\DateTime;

use Korobochkin\WPKit\Tests\DataSets\AbstractDataSet;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class DateTimeTransformationSet
 * @package Korobochkin\WPKit\Tests\DataSets\DateTime
 */
class DateTimeTransformationSet extends AbstractDataSet
{

    /**
     * TypesTransformationSet constructor.
     */
    public function __construct()
    {

        $now = new \DateTime();

        $variants = array(
            // @codingStandardsIgnoreStart
            array($now, $now),

            array(true,        TransformationFailedException::class),
            array(false,       TransformationFailedException::class),

            array(1234,        TransformationFailedException::class),
            array(0,           TransformationFailedException::class),
            array(-1234,       TransformationFailedException::class),
            array(PHP_INT_MAX, TransformationFailedException::class),
            //array(PHP_INT_MIN, true),

            array(1.234,       TransformationFailedException::class),
            array(1.2e3,       TransformationFailedException::class),
            array(7E-10,       TransformationFailedException::class),
            array(-1.234,      TransformationFailedException::class),
            array(-1.2e3,      TransformationFailedException::class),
            array(-7E-10,      TransformationFailedException::class),

            array('1',         TransformationFailedException::class),
            array('VALUE',     TransformationFailedException::class),
            array('true',      TransformationFailedException::class),
            array('false',     TransformationFailedException::class),
            array('',          TransformationFailedException::class),
            array('0',         TransformationFailedException::class),

            array(array(),     TransformationFailedException::class),
            array(array(1),    TransformationFailedException::class),
            array(array(1, 2), TransformationFailedException::class),
            array(array(''),   TransformationFailedException::class),
            array(array('1'),  TransformationFailedException::class),
            array(array('0'),  TransformationFailedException::class),

            array(new \stdClass(), TransformationFailedException::class),
            array(new \WP_Query(), TransformationFailedException::class),

            //array(NULL,        ''), // null tested in separated test
            // @codingStandardsIgnoreEnd
        );

        // Only for PHP 7.
        if (PHP_VERSION_ID >= 70000) {
            $values[] = array(PHP_INT_MIN, TransformationFailedException::class);
        }

        $this->variants = $variants;
        $this->position = 0;
    }
}
