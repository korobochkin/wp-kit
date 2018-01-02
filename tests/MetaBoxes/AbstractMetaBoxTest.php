<?php
namespace Korobochkin\WPKit\Tests\MetaBoxes;

use Korobochkin\WPKit\MetaBoxes\AbstractMetaBox;
use Korobochkin\WPKit\MetaBoxes\MetaBoxTwigView;
use Symfony\Component\Form\FormFactoryBuilder;
use Symfony\Component\HttpFoundation\Request;

class AbstractMetaBoxTest extends \WP_UnitTestCase
{
    const META_BOX_ID = 'wp_kit_test_meta_box_id';

    const META_BOX_TITLE = 'WP Kit Meta Box Test Title';

    const META_BOX_SCREEN = 'post';

    const META_BOX_CONTEXT = 'normal';

    const META_BOX_PRIORITY = 'high';

    /**
     * @var AbstractMetaBox
     */
    protected $stub;

    /**
     * Prepare stub for tests.
     */
    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForAbstractClass(AbstractMetaBox::class);
    }

    public function testRegister()
    {
        $this->stub
            ->setId(self::META_BOX_ID)
            ->setTitle(self::META_BOX_TITLE)
            ->setContext('side');

        $this->assertEquals($this->stub, $this->stub->register());

        $this->assertTrue(has_action('load-post-new.php', array($this->stub, 'lateConstruct')));
        $this->assertTrue(has_action('load-post.php', array($this->stub, 'lateConstruct')));
    }

    public function testLateConstruct()
    {
        $this->assertEquals($this->stub, $this->stub->lateConstruct());
    }

    public function testGetterAndSetterId()
    {
        /**
         * @var $stub AbstractMetaBox
         */
        $stub = $this->getMockForAbstractClass(AbstractMetaBox::class);

        $this->assertEquals(null, $stub->getId());

        $value = self::META_BOX_ID;

        $this->assertEquals($stub, $stub->setId($value));
        $this->assertEquals($value, $stub->getId());
    }

    public function testGetterAndSetterTitle()
    {
        /**
         * @var $stub AbstractMetaBox
         */
        $stub = $this->getMockForAbstractClass(AbstractMetaBox::class);

        $this->assertEquals(null, $stub->getTitle());

        $value = self::META_BOX_TITLE;

        $this->assertEquals($stub, $stub->setTitle($value));
        $this->assertEquals($value, $stub->getTitle());
    }

    public function testGetterAndSetterView()
    {
        /**
         * @var $stub AbstractMetaBox
         */
        $stub = $this->getMockForAbstractClass(AbstractMetaBox::class);

        $this->assertEquals(null, $stub->getView());

        $value = new MetaBoxTwigView();

        $this->assertEquals($stub, $stub->setView($value));
        $this->assertEquals($value, $stub->getView());
    }

    public function testGetterAndSetterScreen()
    {
        /**
         * @var $stub AbstractMetaBox
         */
        $stub = $this->getMockForAbstractClass(AbstractMetaBox::class);

        $this->assertEquals(null, $stub->getScreen());

        $value = self::META_BOX_SCREEN;

        $this->assertEquals($stub, $stub->setScreen($value));
        $this->assertEquals($value, $stub->getScreen());
    }

    public function testGetterAndSetterContext()
    {
        /**
         * @var $stub AbstractMetaBox
         */
        $stub = $this->getMockForAbstractClass(AbstractMetaBox::class);

        $this->assertEquals(null, $stub->getContext());

        $value = self::META_BOX_CONTEXT;

        $this->assertEquals($stub, $stub->setContext($value));
        $this->assertEquals($value, $stub->getContext());
    }

    public function testGetterAndSetterPriority()
    {
        /**
         * @var $stub AbstractMetaBox
         */
        $stub = $this->getMockForAbstractClass(AbstractMetaBox::class);

        $this->assertEquals('default', $stub->getPriority());

        $value = self::META_BOX_PRIORITY;

        $this->assertEquals($stub, $stub->setPriority($value));
        $this->assertEquals($value, $stub->getPriority());
    }

    public function testGetterAndSetterFormFactory()
    {
        $value = new FormFactoryBuilder();
        $value = $value->getFormFactory();

        $this->assertNull($this->stub->getFormFactory());
        $this->assertEquals($this->stub, $this->stub->setFormFactory($value));
        $this->assertEquals($value, $this->stub->getFormFactory());
    }

    public function testGetterAndSetterForm()
    {
        $this->assertNull($this->stub->getForm());
    }

    public function testGetterAndSetterFormEntity()
    {
        $value = new \stdClass();

        $this->assertNull($this->stub->getFormEntity());
        $this->assertEquals($this->stub, $this->stub->setFormEntity($value));
        $this->assertEquals($value, $this->stub->getFormEntity());
    }

    public function testGetterAndSetterRequest()
    {
        /**
         * @var $stub AbstractMetaBox
         */
        $stub = $this->getMockForAbstractClass(AbstractMetaBox::class);

        $this->assertNull($stub->getRequest());

        $value = new Request();

        $this->assertEquals($stub, $stub->setRequest($value));
        $this->assertEquals($value, $stub->getRequest());
    }
}
