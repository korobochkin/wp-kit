<?php
namespace Korobochkin\WPKit\Tests\DataSets;

class AggregateDataSet extends AbstractAssociativeDataSet
{
    /**
     * AggregateDataSet constructor.
     */
    public function __construct()
    {
        $values = array();

        $values['1.'] = array(
            // default value
            array(
                'some_key' => array(
                    'sign-in' => array(
                        'login' => null,
                        'password' => null,
                    ),
                ),
                'another_key' => array(
                    'time' => null,
                ),
            ),
            // value to save
            array(
                'some_key' => array(
                    'sign-in' => array(
                        'login' => 'korobochkin',
                        'password' => 123,
                    ),
                ),
            ),
            // value to return
            array(
                'some_key' => array(
                    'sign-in' => array(
                        'login' => 'korobochkin',
                        'password' => 123,
                    ),
                ),
                'another_key' => array(
                    'time' => null,
                ),
            ),
        );

        $values['2.'] = array(
            // default value
            array(
                'some_key' => array(
                    'sign-in' => array(
                        'login' => null,
                        'password' => null,
                    ),
                ),
                'another_key' => array(
                    'time' => null,
                ),
            ),
            // value to save
            array(
                'some_key' => array(
                    'sign-in' => array(
                        'login' => 'korobochkin',
                    ),
                ),
            ),
            // value to return
            array(
                'some_key' => array(
                    'sign-in' => array(
                        'login' => 'korobochkin',
                        'password' => null,
                    ),
                ),
                'another_key' => array(
                    'time' => null,
                ),
            ),
        );

        $this->values = $values;
    }
}
