<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Options\Special;

use Korobochkin\WPKit\Options\Special\DateTimeOption;
use Korobochkin\WPKit\Tests\Common\DataComponents\Special\AbstractDateTimeDataComponentTest;

/**
 * Class DateTimeOptionTest
 * @package Korobochkin\WPKit\Tests\Options\Special
 *
 * @group data-components
 */
class DateTimeOptionTest extends AbstractDateTimeDataComponentTest
{
    /**
     * @return DateTimeOption
     */
    protected function createAndConfigureStub()
    {
        $stub = new DateTimeOption();
        $stub->setName('wp_kit_datetime_option');

        return $stub;
    }
}
