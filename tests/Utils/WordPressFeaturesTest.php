<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Utils;

use Korobochkin\WPKit\Utils\WordPressFeatures;

class WordPressFeaturesTest extends \WP_UnitTestCase
{
    public function testIsTermsMetaSupported()
    {
        $this->assertTrue(is_bool(WordPressFeatures::isTermsMetaSupported()));
    }

    public function testIsDebug()
    {
        $this->assertTrue(WordPressFeatures::isDebug());
    }

    public function testIsScriptDebug()
    {
        $this->assertFalse(WordPressFeatures::isScriptDebug());
    }
}
