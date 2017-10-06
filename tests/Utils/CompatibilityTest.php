<?php
namespace Korobochkin\WPKit\Tests\Utils;

use Korobochkin\WPKit\Tests\DataSets\MinimalVersionSet;
use Korobochkin\WPKit\Utils\Compatibility;

class CompatibilityTest extends \WP_UnitTestCase
{
    /**
     * @dataProvider casesCheckForMinimalVersion
     *
     * @param $currentVersion string
     * @param $minimalVersion string
     * @param $result bool
     */
    public function testCheckForMinimalVersion($currentVersion, $minimalVersion, $result)
    {
        $this->assertEquals($result, Compatibility::checkForMinimalVersion($currentVersion, $minimalVersion));
    }

    public function casesCheckForMinimalVersion()
    {
        return new MinimalVersionSet();
    }
}
