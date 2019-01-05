<?php
namespace Korobochkin\WPKit\Tests\Uninstall;

use Korobochkin\WPKit\Cron\AbstractCronEvent;
use Korobochkin\WPKit\Options\Option;
use Korobochkin\WPKit\PostMeta\PostMeta;
use Korobochkin\WPKit\TermMeta\TermMeta;
use Korobochkin\WPKit\Transients\Transient;
use Korobochkin\WPKit\Uninstall\Uninstall;

class UninstallTest extends \WP_UnitTestCase
{
    /**
     * @var Uninstall
     */
    protected $stub;

    /**
     * @inheritdoc
     */
    function setUp()
    {
        parent::setUp();
        $this->stub = new Uninstall();
    }

    public function testGetterAndSetterCronEvents()
    {
        $this->assertNull($this->stub->getCronEvents());
        $value = array(
            $this->getMockForAbstractClass(AbstractCronEvent::class),
        );
        $this->assertSame($this->stub, $this->stub->setCronEvents($value));
        $this->assertSame($value, $this->stub->getCronEvents());
    }

    public function testGetterAndSetterOptions()
    {
        $this->assertNull($this->stub->getOptions());
        $value = array(
            new Option(),
        );
        $this->assertSame($this->stub, $this->stub->setOptions($value));
        $this->assertSame($value, $this->stub->getOptions());
    }

    public function testGetterAndSetterPostMetas()
    {
        $this->assertNull($this->stub->getPostMetas());
        $value = array(
            new PostMeta(),
        );
        $this->assertSame($this->stub, $this->stub->setPostMetas($value));
        $this->assertSame($value, $this->stub->getPostMetas());
    }

    public function testGetterAndSetterTermMetas()
    {
        $this->assertNull($this->stub->getTermMetas());
        $value = array(
            new TermMeta(),
        );
        $this->assertSame($this->stub, $this->stub->setTermMetas($value));
        $this->assertSame($value, $this->stub->getTermMetas());
    }

    public function testGetterAndSetterTransients()
    {
        $this->assertNull($this->stub->getTransients());
        $value = array(
            new Transient(),
        );
        $this->assertSame($this->stub, $this->stub->setTransients($value));
        $this->assertSame($value, $this->stub->getTransients());
    }

    public function testGetterAndSetterSuppressExceptions()
    {
        $this->assertFalse($this->stub->isSuppressExceptions());
        $value = true;
        $this->assertSame($this->stub, $this->stub->setSuppressExceptions($value));
        $this->assertSame($value, $this->stub->isSuppressExceptions());
    }

    public function testRun()
    {
        $this->assertSame($this->stub, $this->stub->run());
    }

    public function testFlushAfterRun()
    {
        $this->assertSame($this->stub, $this->stub->flushAfterRun());
    }

    public function testDeleteCronEventsEmpty()
    {
        $this->assertSame($this->stub, $this->stub->deleteCronEvents());
    }

    public function testDeleteOptionsEmpty()
    {
        $this->assertSame($this->stub, $this->stub->deleteOptions());
    }

    public function testDeletePostMetasEmpty()
    {
        $this->assertSame($this->stub, $this->stub->deletePostMetas());
    }

    public function testDeleteTermMetasEmpty()
    {
        $this->assertSame($this->stub, $this->stub->deleteTermMetas());
    }

    public function testDeleteTransientsEmpty()
    {
        $this->assertSame($this->stub, $this->stub->deleteTransients());
    }

    public function testDeleteCronEvents()
    {
        /**
         * @var $cronEvent AbstractCronEvent
         * @var $cronEvent2 AbstractCronEvent
         */
        $cronEvent = $this->getMockForAbstractClass(AbstractCronEvent::class);
        $cronEvent
            ->setName($name = 'wp_kit_uninstall_service_test_cron_event')
            ->setTimestamp($time = time())
            ->schedule();

        $cronEvent2 = $this->getMockForAbstractClass(AbstractCronEvent::class);
        $cronEvent2
            ->setName($name2 = 'wp_kit_uninstall_service_test_cron_event_2')
            ->setTimestamp($time2 = time())
            ->schedule();

        $this->stub->setCronEvents(array($cronEvent, $cronEvent2))->deleteCronEvents();

        $tasks = _get_cron_array();
        $this->assertFalse(isset($tasks[$time][$name]));
        $this->assertFalse(isset($tasks[$time2][$name2]));
    }

    public function testDeleteOptions()
    {
        $option = new Option();
        $option
            ->setName($name = 'wp_kit_uninstall_service_test_option')
            ->updateValue('123');

        $option2 = new Option();
        $option2
            ->setName($name2 = 'wp_kit_uninstall_service_test_option_2')
            ->updateValue('234');

        $this->stub->setOptions(array($option, $option2))->deleteOptions();

        $this->assertFalse(get_option($name));
        $this->assertFalse(get_option($name2));

    }

    public function testDeletePostMetas()
    {
        $postId = wp_insert_post(
            array(
                'post_content' => 'WP Kit demo post.',
                'post_title'   => 'WP Kit demo title',
            )
        );

        $postMeta = new PostMeta();
        $postMeta
            ->setName($name = 'wp_kit_uninstall_service_test_post_meta')
            ->setVisibility(true)
            ->setPostId($postId)
            ->updateValue('123');

        $postMeta2 = new PostMeta();
        $postMeta2
            ->setName($name2 = 'wp_kit_uninstall_service_test_post_meta_2')
            ->setVisibility(true)
            ->setPostId($postId)
            ->updateValue('234');

        $this->stub->setPostMetas(array($postMeta, $postMeta2))->deletePostMetas();
        $this->assertFalse(get_post_meta($postId, $name, true));
        $this->assertFalse(get_post_meta($postId, $name2, true));
    }

    public function testDeleteTermMetas()
    {
        if (!WordPressFeatures::isTermsMetaSupported()) {
            // Skip tests on WP bellow 4.4 since it doesn't have required functions.
            $this->markTestSkipped('Term meta features not supported in WordPress bellow 4.4');
        }

        $term = wp_insert_term('Test Term with PHP Unit', 'category', array(
            'description' => 'Description for Test Term',
            'slug' => 'test-term-with-php-unit',
        ));

        $termMeta = new TermMeta();
        $termMeta
            ->setName($name = 'wp_kit_uninstall_service_test_term_meta')
            ->setTermId($term['term_id'])
            ->updateValue('123');

        $termMeta2 = new TermMeta();
        $termMeta2
            ->setName($name2 = 'wp_kit_uninstall_service_test_term_meta_2')
            ->setTermId($term['term_id'])
            ->updateValue('234');

        $this->stub->setTermMetas(array($termMeta, $termMeta2))->deleteTermMetas();
        $this->assertFalse(get_term_meta($term['term_id'], $name, true));
        $this->assertFalse(get_term_meta($term['term_id'], $name2, true));
    }

    public function testDeleteTransients()
    {
        $transient = new Transient();
        $transient
            ->setName($name = 'wp_kit_uninstall_service_test_transient')
            ->updateValue('123');

        $transient2 = new Transient();
        $transient2
            ->setName($name2 = 'wp_kit_uninstall_service_test_transient_2')
            ->updateValue('234');

        $this->stub->setTransients(array($transient, $transient2))->deleteTransients();

        $this->assertFalse(get_transient($name));
        $this->assertFalse(get_transient($name2));
    }
}
