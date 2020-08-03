<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Transients\Special;

use Korobochkin\WPKit\Tests\Common\DataComponents\Special\AbstractDateTimeDataComponentTest;
use Korobochkin\WPKit\Transients\Special\DateTimeTransient;

/**
 * Class DateTimeTransientTest
 * @package Korobochkin\WPKit\Tests\Transients\Special
 *
 * @group data-components
 */
class DateTimeTransientTest extends AbstractDateTimeDataComponentTest
{
    /**
     * @return DateTimeTransient
     */
    protected function createAndConfigureStub()
    {
        $stub = new DateTimeTransient();
        $stub->setName('wp_kit_datetime_transient');

        return $stub;
    }
}
