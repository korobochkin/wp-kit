<?php
namespace Korobochkin\WPKit\Tests\Sanitizers;

use Korobochkin\WPKit\Sanitizers\BoolSanitizer;
use Korobochkin\WPKit\Tests\DataSets\Bool\BoolSanitizeSet;

class BoolSanitizerTest extends \WP_UnitTestCase
{
    /**
     * @dataProvider casesSanitize
     * @param $value mixed Input value.
     * @param $expected bool Result of sanitizing.
     */
    public function testSanitize($value, $expected)
    {
        $this->assertSame($expected, BoolSanitizer::sanitize($value));
    }

    public function casesSanitize()
    {
        return new BoolSanitizeSet();
    }
}
