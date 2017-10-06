<?php
namespace Korobochkin\WPKit\Tests\DataSets;

class MinimalVersionSet extends AbstractAssociativeDataSet
{
    /**
     * MinimalVersionSet constructor.
     */
    public function __construct()
    {
        $this->values = array(
            '1' => array(
                // current version // minimal version // result
                '1.0.0',              '1.0.0',           true,
            ),
            '2' => array(
                // current version // minimal version // result
                '2.0.0',              '1.0.0',           true,
            ),
            '3' => array(
                // current version // minimal version // result
                '2.0.0',              '1.0.0',           true,
            ),
            '4' => array(
                // current version // minimal version // result
                '2.0.0',              '4.0.0',           false,
            ),
            '5' => array(
                // current version // minimal version // result
                '4.0.0',              '1.0.0',           true,
            ),
            '6' => array(
                // current version // minimal version // result
                '4.0.0',              '4.0.0',           true,
            ),
            '7' => array(
                // current version // minimal version // result
                '4.0.0',              '4.2',             false,
            ),
            '8' => array(
                // current version // minimal version // result
                '4.4',              '3.0',               true,
            ),
            '9' => array(
                // current version // minimal version // result
                '4.4',              '4.4.0',             false,
            ),
            '10' => array(
                // current version // minimal version // result
                '4.4',              '4.4.1',             false,
            ),
            '11' => array(
                // current version // minimal version // result
                '4.9-beta1-41780',  '4.8',               true,
            ),
            '12' => array(
                // current version // minimal version // result
                '4.9-beta1-41780',  '4.9',               false,
            ),
            '13' => array(
                // current version // minimal version // result
                '4.9-beta2-41781',  '4.9-beta3-41781',   false,
            ),
        );
    }
}
