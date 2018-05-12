<?php
namespace Korobochkin\WPKit\Tests\MetaBoxes;

use Korobochkin\WPKit\MetaBoxes\MetaBox;
use Korobochkin\WPKit\MetaBoxes\MetaBoxTwigView;
use Symfony\Component\Form\FormFactoryBuilder;
use Symfony\Component\HttpFoundation\Request;

class MetaBoxTest extends \WP_UnitTestCase
{
    const META_BOX_ID = 'wp_kit_test_meta_box_id';

    const META_BOX_TITLE = 'WP Kit Meta Box Test Title';

    const META_BOX_SCREEN = 'post';

    const META_BOX_CONTEXT = 'normal';

    const META_BOX_PRIORITY = 'high';

    /**
     * @var MetaBox
     */
    protected $stub;

    /**
     * Prepare stub for tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->stub = new MetaBox();
    }

    public function testRegister()
    {
        $this->stub
            ->setId(self::META_BOX_ID)
            ->setTitle(self::META_BOX_TITLE)
            ->setContext('side');

        $this->assertSame($this->stub, $this->stub->register());

        $this->assertInternalType('int', has_action('load-post-new.php', array($this->stub, 'lateConstruct')));
        $this->assertInternalType('int', has_action('load-post.php', array($this->stub, 'lateConstruct')));
    }

    public function testLateConstruct()
    {
        $this->assertSame($this->stub, $this->stub->lateConstruct());
    }

    public function testGetterAndSetterId()
    {
        /**
         * @var $stub MetaBox
         */
        $stub = new MetaBox();

        $this->assertSame(null, $stub->getId());

        $value = self::META_BOX_ID;

        $this->assertSame($stub, $stub->setId($value));
        $this->assertSame($value, $stub->getId());
    }

    public function testGetterAndSetterTitle()
    {
        /**
         * @var $stub MetaBox
         */
        $stub = new MetaBox();

        $this->assertSame(null, $stub->getTitle());

        $value = self::META_BOX_TITLE;

        $this->assertSame($stub, $stub->setTitle($value));
        $this->assertSame($value, $stub->getTitle());
    }

    public function testGetterAndSetterView()
    {
        /**
         * @var $stub MetaBox
         */
        $stub = new MetaBox();

        $this->assertSame(null, $stub->getView());

        $value = new MetaBoxTwigView();

        $this->assertSame($stub, $stub->setView($value));
        $this->assertSame($value, $stub->getView());
    }

    public function testGetterAndSetterScreen()
    {
        /**
         * @var $stub MetaBox
         */
        $stub = new MetaBox();

        $this->assertSame(null, $stub->getScreen());

        $value = self::META_BOX_SCREEN;

        $this->assertSame($stub, $stub->setScreen($value));
        $this->assertSame($value, $stub->getScreen());
    }

    public function testGetterAndSetterContext()
    {
        /**
         * @var $stub MetaBox
         */
        $stub = new MetaBox();

        $this->assertSame(null, $stub->getContext());

        $value = self::META_BOX_CONTEXT;

        $this->assertSame($stub, $stub->setContext($value));
        $this->assertSame($value, $stub->getContext());
    }

    public function testGetterAndSetterPriority()
    {
        /**
         * @var $stub MetaBox
         */
        $stub = new MetaBox();

        $this->assertSame('default', $stub->getPriority());

        $value = self::META_BOX_PRIORITY;

        $this->assertSame($stub, $stub->setPriority($value));
        $this->assertSame($value, $stub->getPriority());
    }

    public function testGetterAndSetterFormFactory()
    {
        $value = new FormFactoryBuilder();
        $value = $value->getFormFactory();

        $this->assertNull($this->stub->getFormFactory());
        $this->assertSame($this->stub, $this->stub->setFormFactory($value));
        $this->assertSame($value, $this->stub->getFormFactory());
    }

    public function testGetterAndSetterForm()
    {
        $this->assertNull($this->stub->getForm());
    }

    public function testGetterAndSetterFormEntity()
    {
        $value = new \stdClass();

        $this->assertNull($this->stub->getFormEntity());
        $this->assertSame($this->stub, $this->stub->setFormEntity($value));
        $this->assertSame($value, $this->stub->getFormEntity());
    }

    public function testGetterAndSetterRequest()
    {
        /**
         * @var $stub MetaBox
         */
        $stub = new MetaBox();

        $this->assertNull($stub->getRequest());

        $value = new Request();

        $this->assertSame($stub, $stub->setRequest($value));
        $this->assertSame($value, $stub->getRequest());
    }
}
