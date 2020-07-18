<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\TermMeta\Special;

use Korobochkin\WPKit\TermMeta\Special\BoolTermMeta;
use Korobochkin\WPKit\Tests\Common\DataComponents\Special\AbstractBoolDataComponentTest;
use Korobochkin\WPKit\Utils\WordPressFeatures;

/**
 * Class BoolTermMetaTest
 * @package Korobochkin\WPKit\Tests\TermMeta\Special
 *
 * @group data-components
 */
class BoolTermMetaTest extends AbstractBoolDataComponentTest
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
        parent::setUp();
    }

    /**
     * @return BoolTermMeta
     */
    protected function createAndConfigureStub()
    {
        $term = wp_insert_term('Test Term with PHP Unit', 'category', array(
            'description' => 'Description for Test Term',
            'slug' => 'test-term-with-php-unit',
        ));

        $this->termId = $term['term_id'];

        $stub = new BoolTermMeta();
        $stub->setName('wp_kit_bool_term_meta');
        $stub->setTermId($this->termId);

        return $stub;
    }
}
