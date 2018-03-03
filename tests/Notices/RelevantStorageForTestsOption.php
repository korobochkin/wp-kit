<?php
namespace Korobochkin\WPKit\Tests\Notices;

use Korobochkin\WPKit\Options\Special\BoolOption;

class RelevantStorageForTestsOption extends BoolOption
{
    /**
     * RelevantStorageForTestsOption constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setName('wp_kit_relevant_storage_test');
    }
}
