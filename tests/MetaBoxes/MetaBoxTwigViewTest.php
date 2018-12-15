<?php
namespace Korobochkin\WPKit\Tests\MetaBoxes;

use Korobochkin\WPKit\MetaBoxes\MetaBox;
use Korobochkin\WPKit\MetaBoxes\MetaBoxTwigView;

/**
 * Class MetaBoxTwigViewTest
 */
class MetaBoxTwigViewTest extends \WP_UnitTestCase
{
    public function testRender()
    {
        /**
         * @var $stub MetaBoxTwigView
         */
        $stub    = new MetaBoxTwigView();
        $metaBox = new MetaBox();

        $value = new \Twig_Environment(
            new \Twig_Loader_Array(array(
                'title' => '{{ "my first car"|title }}',
                'min'   => '{{ min(1, 3, 2) }}',
            ))
        );

        $stub->setTwigEnvironment($value);

        ob_start();
        $stub->setTemplate('title');
        $stub->render($metaBox);
        $this->assertSame('My First Car', ob_get_contents());
        ob_end_clean();

        ob_start();
        $stub->setTemplate('min');
        $stub->render($metaBox);
        $this->assertSame('1', ob_get_contents());
        ob_end_clean();
    }

    public function testGetterAndSetterTemplate()
    {
        /**
         * @var $stub MetaBoxTwigView
         */
        $stub = new MetaBoxTwigView();

        $this->assertSame('', $stub->getTemplate());

        $value = 'test-template.twig.html';

        $this->assertSame($stub, $stub->setTemplate($value));
        $this->assertSame($value, $stub->getTemplate());
    }

    public function testGetterAndSetterContext()
    {
        /**
         * @var $stub MetaBoxTwigView
         */
        $stub = new MetaBoxTwigView();

        $this->assertSame(array(), $stub->getContext());

        $value = array(
            'some_key' => 'some value',
        );

        $this->assertSame($stub, $stub->setContext($value));
        $this->assertSame($value, $stub->getContext());
    }

    public function testGetterAndSetterTwigEnvironment()
    {
        /**
         * @var $stub MetaBoxTwigView
         */
        $stub = new MetaBoxTwigView();

        $this->assertSame(null, $stub->getTwigEnvironment());

        $value = new \Twig_Environment(
            new \Twig_Loader_Array(array(
                'title' => '{{ "my first car"|title }}',
            ))
        );

        $this->assertSame($stub, $stub->setTwigEnvironment(($value)));
        $this->assertSame($value, $stub->getTwigEnvironment());
    }
}
