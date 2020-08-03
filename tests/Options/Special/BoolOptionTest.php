<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Options\Special;

use Korobochkin\WPKit\Options\Special\BoolOption;
use Korobochkin\WPKit\Tests\Common\DataComponents\Special\AbstractBoolDataComponentTest;

/**
 * Class BoolOptionTest
 * @package Korobochkin\WPKit\Tests\Options\Special
 *
 * @group data-components
 */
class BoolOptionTest extends AbstractBoolDataComponentTest
{
    /**
     * @return BoolOption
     */
    protected function createAndConfigureStub()
    {
        $stub = new BoolOption();
        $stub->setName('wp_kit_bool_option');
        return $stub;
    }
}
