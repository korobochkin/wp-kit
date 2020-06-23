<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Sanitizers;

use Korobochkin\WPKit\Sanitizers\IntegerSanitizer;
use Korobochkin\WPKit\Tests\DataSets\IntegerSanitizeSet;

class IntegerSanitizerTest extends \WP_UnitTestCase
{
    /**
     * @dataProvider casesSanitize
     * @param $value mixed Input value.
     * @param $expected int Result of sanitizing.
     */
    public function testSanitize($value, $expected)
    {
        $this->assertSame($expected, IntegerSanitizer::sanitize($value));
    }

    public function casesSanitize()
    {
        return new IntegerSanitizeSet();
    }
}
