<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\DataSets;

use Symfony\Component\Validator\Constraints;

/**
 * Class ValidateSet
 * @package Korobochkin\WPKit\Tests\DataSets
 */
class ValidateSet extends AbstractDataSet
{
    /**
     * ValidateSet constructor.
     */
    public function __construct()
    {
        $variants = array();

        $variants[] = array(
            'wp_kit_test_value',
            array(
                new Constraints\NotNull(),
                new Constraints\EqualTo(
                    array(
                        'value' => 'wp_kit_test_value',
                    )
                ),
            ),
            true,
        );

        $variants[] = array(
            'wp_kit_test_value',
            new Constraints\Type(
                array(
                    'type' => 'string',
                )
            ),
            true,
        );

        $variants[] = array(
            'wp_kit_test_value',
            array(
                new Constraints\NotNull(),
                new Constraints\Email(),
            ),
            false,
        );

        $variants[] = array(
            'wp_kit_test_value',
            new Constraints\Type(
                array(
                    'type' => 'bool',
                )
            ),
            false,
        );

        $variants[] = array(
            'wp_kit_test_value',
            new Constraints\Choice(array(
                'choices' => array(1, 2, 3),
                'multiple' => true,
                'strict' => true,
            )),
            false,
        );

        $this->variants = $variants;
        $this->position = 0;
    }
}
