<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\TermMeta\Special;

use Korobochkin\WPKit\TermMeta\Special\DateTimeTermMeta;
use Korobochkin\WPKit\Tests\Common\DataComponents\Special\AbstractDateTimeDataComponentTest;
use Korobochkin\WPKit\Utils\Compatibility;
use Korobochkin\WPKit\Utils\WordPressFeatures;

/**
 * Class DateTimeTermMetaTest
 * @package Korobochkin\WPKit\Tests\TermMeta\Special
 *
 * @group data-components
 */
class DateTimeTermMetaTest extends AbstractDateTimeDataComponentTest
{
    /**
     * @var int Term ID for accessing post meta.
     */
    protected $termId;

    public function setUp()
    {
        if (!WordPressFeatures::isTermsMetaSupported()) {
            // Skip tests on WP bellow 4.4 since it doesn't have required functions.
            $this->markTestSkipped('Term meta features not supported in WordPress bellow 4.4');
        }

        if (!Compatibility::checkWordPress('5.3') && PHP_VERSION_ID >= 70400) {
            // WP <5.3 && PHP >= 7.4
            $this->markTestSkipped('https://core.trac.wordpress.org/ticket/47783');
        }

        parent::setUp();
    }

    /**
     * @return DateTimeTermMeta
     */
    protected function createAndConfigureStub()
    {
        if (!Compatibility::checkWordPress('5.3') && PHP_VERSION_ID >= 70400) {
            $this->markTestSkipped('https://core.trac.wordpress.org/ticket/47783');
        }

        $result = wp_insert_term('Test Term with PHP Unit', 'category', array(
            'description' => 'Description for Test Term',
            'slug' => 'test-term-with-php-unit',
        ));

        $this->termId = $result['term_id'];

        $stub = new DateTimeTermMeta();
        $stub->setName('wp_kit_datetime_term_meta');
        $stub->setTermId($this->termId);

        return $stub;
    }
}
