<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Transients\Special;

use Korobochkin\WPKit\Tests\Common\DataComponents\Special\AbstractBoolDataComponentTest;
use Korobochkin\WPKit\Transients\Special\BoolTransient;

/**
 * Class BoolTransientTest
 * @package Korobochkin\WPKit\Tests\Transients\Special
 *
 * @group data-components
 */
class BoolTransientTest extends AbstractBoolDataComponentTest
{
    /**
     * @return BoolTransient
     */
    protected function createAndConfigureStub()
    {
        $stub = new BoolTransient();
        $stub->setName('wp_kit_bool_transient');

        return $stub;
    }
}
