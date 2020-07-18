<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Notices;

use Korobochkin\WPKit\Notices\Notice;
use Korobochkin\WPKit\Notices\NoticeTwigView;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

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

        $value = new Environment(
            new ArrayLoader(array(
                'title' => '{{ "my first car"|title }}',
                'min'   => '{{ min(1, 3, 2) }}',
            ))
        );

        $stub->setTwigEnvironment(($value));

        ob_start();
        $stub->setTemplate('title');
        $stub->render($notice);
        $this->assertSame('My First Car', ob_get_contents());
        ob_end_clean();

        ob_start();
        $stub->setTemplate('min');
        $stub->render($notice);
        $this->assertSame('1', ob_get_contents());
        ob_end_clean();
    }

    public function testGetterAndSetterTemplate()
    {
        /**
         * @var $stub NoticeTwigView
         */
        $stub = new NoticeTwigView();

        $this->assertSame('', $stub->getTemplate());

        $value = 'test-template.twig.html';

        $this->assertSame($stub, $stub->setTemplate($value));
        $this->assertSame($value, $stub->getTemplate());
    }

    public function testGetterAndSetterContext()
    {
        /**
         * @var $stub NoticeTwigView
         */
        $stub = new NoticeTwigView();

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
         * @var $stub NoticeTwigView
         */
        $stub = new NoticeTwigView();

        $this->assertNull($stub->getTwigEnvironment());

        $value = new Environment(
            new ArrayLoader(array(
                'title' => '{{ "my first car"|title }}',
            ))
        );

        $this->assertSame($stub, $stub->setTwigEnvironment(($value)));
        $this->assertSame($value, $stub->getTwigEnvironment());
    }
}
