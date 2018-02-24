<?php
namespace Korobochkin\WPKit\Tests\Notices;

use Korobochkin\WPKit\Notices\Notice;
use Korobochkin\WPKit\Notices\NoticeTwigView;

/**
 * Class NoticeTwigViewTest
 */
class NoticeTwigViewTest extends \WP_UnitTestCase
{
    public function testRender()
    {
        /**
         * @var $stub NoticeTwigView
         */
        $stub   = new NoticeTwigView();
        $notice = new Notice();

        $value = new \Twig_Environment(
            new \Twig_Loader_Array(array(
                'title' => '{{ "my first car"|title }}',
                'min'   => '{{ min(1, 3, 2) }}',
            ))
        );

        $stub->setTwigEnvironment(($value));

        ob_start();
        $stub->setTemplate('title');
        $stub->render($notice);
        $this->assertEquals('My First Car', ob_get_contents());
        ob_end_clean();

        ob_start();
        $stub->setTemplate('min');
        $stub->render($notice);
        $this->assertEquals('1', ob_get_contents());
        ob_end_clean();
    }

    public function testGetterAndSetterTemplate()
    {
        /**
         * @var $stub NoticeTwigView
         */
        $stub = new NoticeTwigView();

        $this->assertNull($stub->getTemplate());

        $value = 'test-template.twig.html';

        $this->assertEquals($stub, $stub->setTemplate($value));
        $this->assertEquals($value, $stub->getTemplate());
    }

    public function testGetterAndSetterContext()
    {
        /**
         * @var $stub NoticeTwigView
         */
        $stub = new NoticeTwigView();

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
         * @var $stub NoticeTwigView
         */
        $stub = new NoticeTwigView();

        $this->assertNull($stub->getTwigEnvironment());

        $value = new \Twig_Environment(
            new \Twig_Loader_Array(array(
                'title' => '{{ "my first car"|title }}',
            ))
        );

        $this->assertEquals($stub, $stub->setTwigEnvironment(($value)));
        $this->assertEquals($value, $stub->getTwigEnvironment());
    }
}
