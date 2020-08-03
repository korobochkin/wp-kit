<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Options\Special;

use Korobochkin\WPKit\Options\Special\NumericOption;
use Korobochkin\WPKit\Tests\Common\DataComponents\Special\AbstractNumericDataComponentTest;

/**
 * Class NumericOptionTest
 * @package Korobochkin\WPKit\Tests\Options\Special
 *
 * @group data-components
 */
class NumericOptionTest extends AbstractNumericDataComponentTest
{
    /**
     * @return NumericOption
     */
    protected function createAndConfigureStub()
    {
        $stub = new NumericOption();
        $stub->setName('wp_kit_numeric_option');

        return $stub;
    }
}
