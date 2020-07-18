<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\TermMeta\Special;

use Korobochkin\WPKit\TermMeta\Special\NumericTermMeta;
use Korobochkin\WPKit\Tests\Common\DataComponents\Special\AbstractNumericDataComponentTest;
use Korobochkin\WPKit\Utils\WordPressFeatures;

/**
 * Class NumericTermMetaTest
 * @package Korobochkin\WPKit\Tests\TermMeta\Special
 *
 * @group data-components
 */
class NumericTermMetaTest extends AbstractNumericDataComponentTest
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
     * @return NumericTermMeta
     */
    protected function createAndConfigureStub()
    {
        $this->termId = wp_insert_post(array(
            'post_content' => 'WP Kit demo post.',
            'post_title'   => 'WP Kit demo title',
        ));

        $stub = new NumericTermMeta();
        $stub->setName('wp_kit_numeric_term_meta');
        $stub->setTermId($this->termId);

        return $stub;
    }
}
