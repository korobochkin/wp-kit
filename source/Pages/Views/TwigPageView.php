<?php
namespace Korobochkin\WPKit\Pages\Views;

use Korobochkin\WPKit\Pages\PageInterface;

/**
 * Class TwigPageView
 */
class TwigPageView implements PageViewInterface
{
    /**
     * @var string Twig template path.
     */
    protected $template = '';

    /**
     * @var string[] Array with context for Twig.
     */
    protected $context = array();

    /**
     * @var \Twig_Environment
     */
    protected $twigEnvironment;

    /**
     * @inheritdoc
     */
    public function render(PageInterface $page)
    {
        echo $this->getTwigEnvironment()->render($this->getTemplate(), $this->getContext());
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $template
     *
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return array
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param array $context Content for Twig
     *
     * @return $this
     */
    public function setContext(array $context)
    {
        $this->context = $context;
        return $this;
    }

    /**
     * @return \Twig_Environment
     */
    public function getTwigEnvironment()
    {
        return $this->twigEnvironment;
    }

    /**
     * @param \Twig_Environment $twigEnvironment
     *
     * @return $this
     */
    public function setTwigEnvironment($twigEnvironment)
    {
        $this->twigEnvironment = $twigEnvironment;
        return $this;
    }
}
