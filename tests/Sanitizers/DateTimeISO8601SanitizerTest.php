<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Sanitizers;

use Korobochkin\WPKit\Sanitizers\DateTimeISO8601Sanitizer;

class DateTimeISO8601SanitizerTest extends \WP_UnitTestCase
{
    /**
     * @dataProvider casesSanitize
     * @param $value mixed Input value.
     * @param $expected mixed Result of sanitizing.
     */
    public function testSanitize($value, $expected)
    {
        $result = DateTimeISO8601Sanitizer::sanitize($value);
        if (\DateTime::class === $expected) {
            $this->assertInstanceOf($expected, $result);
        } else {
            $this->assertFalse($result);
        }
    }

    public function casesSanitize()
    {
        return array(
            array('2018-12-16T18:30:12+00:00', \DateTime::class),
            array('2018-12-16T18:30:12Z', \DateTime::class),
            array('20181216T183012Z', false),
            array('STRING', false)
        );
    }
}
