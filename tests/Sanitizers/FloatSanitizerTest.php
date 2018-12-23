<?php
namespace Korobochkin\WPKit\Tests\Sanitizers;

use Korobochkin\WPKit\Sanitizers\FloatSanitizer;
use Korobochkin\WPKit\Tests\DataSets\FloatSanitizeSet;

class FloatSanitizerTest extends \WP_UnitTestCase
{
    /**
     * @dataProvider casesSanitize
     * @param $value mixed Input value.
     * @param $expected float Result of sanitizing.
     */
    public function testSanitize($value, $expected)
    {
        $this->assertSame($expected, FloatSanitizer::sanitize($value));
    }

    public function casesSanitize()
    {
        return new FloatSanitizeSet();
    }
}
