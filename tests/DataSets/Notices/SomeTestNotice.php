<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\DataSets\Notices;

use Korobochkin\WPKit\Notices\Notice;

/**
 * Class SomeTestNotice
 */
class SomeTestNotice extends Notice
{
    /**
     * SomeTestNotice constructor.
     */
    public function __construct()
    {
        $this->setName('some_test');
    }
}
