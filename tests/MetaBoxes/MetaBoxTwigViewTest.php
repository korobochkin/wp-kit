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
        $stub = new MetaBoxTwigView();
        $metaBox = new MetaBox();

        $value = new \Twig_Environment(
            new \Twig_Loader_Array(array(
                'title' => '{{ "my first car"|title }}',
                'min'   => '{{ min(1, 3, 2) }}',
            ))
        );

        $stub->setTwigEnvironment(($value));

        ob_start();
        $stub->setTemplate('title');
        $stub->render($metaBox);
        $this->assertEquals('My first car', ob_get_clean());

        $stub->setTemplate('min');
        $stub->render($metaBox);
        $this->assertEquals('1', ob_get_clean());
    }

    public function testGetterAndSetterTemplate()
    {
        /**
         * @var $stub MetaBoxTwigView
         */
        $stub = new MetaBoxTwigView();

        $this->assertEquals(null, $stub->getTemplate());

        $value = 'test-template.twig.html';

        $this->assertEquals($stub, $stub->setTemplate($value));
        $this->assertEquals($value, $stub->getTemplate());
    }

    public function testGetterAndSetterContext()
    {
        /**
         * @var $stub MetaBoxTwigView
         */
        $stub = new MetaBoxTwigView();

        $this->assertEquals(array(), $stub->getContext());

        $value = array(
            'some_key' => 'some value',
        );

        $this->assertEquals($stub, $stub->setContext($value));
        $this->assertEquals($value, $stub->getContext());
    }

    public function testGetterAndSetterTwigEnvironment()
    {
        /**
         * @var $stub MetaBoxTwigView
         */
        $stub = new MetaBoxTwigView();

        $this->assertEquals(null, $stub->getTwigEnvironment());

        $value = new \Twig_Environment(
            new \Twig_Loader_Array(array(
                'title' => '{{ "my first car"|title }}',
            ))
        );

        $this->assertEquals($stub, $stub->setTwigEnvironment(($value)));
        $this->assertEquals($value, $stub->getTwigEnvironment());
    }
}
