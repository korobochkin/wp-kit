<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Transients\Special;

use Korobochkin\WPKit\Tests\Common\DataComponents\Special\AbstractNumericDataComponentTest;
use Korobochkin\WPKit\Transients\Special\NumericTransient;

/**
 * Class NumericTransientTest
 * @package Korobochkin\WPKit\Tests\Transients\Special
 *
 * @group data-components
 */
class NumericTransientTest extends AbstractNumericDataComponentTest
{
    /**
     * @return NumericTransient
     */
    protected function createAndConfigureStub()
    {
        $stub = new NumericTransient();
        $stub->setName('wp_kit_numeric_transient');

        return $stub;
    }
}
