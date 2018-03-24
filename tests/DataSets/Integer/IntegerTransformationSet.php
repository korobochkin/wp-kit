<?php
namespace Korobochkin\WPKit\Tests\DataSets\Integer;

use Korobochkin\WPKit\Tests\DataSets\AbstractDataSet;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class IntegerTransformationSet
 */
class IntegerTransformationSet extends AbstractDataSet
{
    public function __construct()
    {
        $variants = array(
            array(true,        TransformationFailedException::class),
            array(false,       TransformationFailedException::class),

            array(1234,        1234),
            array(0,           0),
            array(-1234,       -1234),

            array(1.234,       1),
            array(1.2e3,       1200),
            array(7E-10,       0),
            array(-1.234,      -1),
            array(-1.2e3,      -1200),
            array(-7E-10,      0),

            array('1',         1),
            array('VALUE',     TransformationFailedException::class),
            array('true',      TransformationFailedException::class),
            array('false',     TransformationFailedException::class),
            array('',          TransformationFailedException::class),
            array('0',         0),

            array(array(),     TransformationFailedException::class),
            array(array(1),    TransformationFailedException::class),
            array(array(1, 2), TransformationFailedException::class),
            array(array(''),   TransformationFailedException::class),
            array(array('1'),  TransformationFailedException::class),
            array(array('0'),  TransformationFailedException::class),

            array(new \stdClass(), TransformationFailedException::class),
            array(new \WP_Query(), TransformationFailedException::class),

            array(null,        0),
        );

        // Only for PHP 7 or later.
        if (PHP_VERSION_ID >= 70000) {
            $values[] = array(PHP_INT_MIN, TransformationFailedException::class);
        }

        $this->variants = $variants;
    }
}
