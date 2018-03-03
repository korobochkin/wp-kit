<?php
namespace Korobochkin\WPKit\Notices;

/**
 * Class NoticeTwigView
 */
class NoticeTwigView implements NoticeViewInterface, NoticeTwigViewInterface
{
    /**
     * @var string Twig template (path).
     */
    protected $template = '';

    /**
     * @var string[] Array with variables.
     */
    protected $context = array();

    /**
     * @var \Twig_Environment Twig.
     */
    protected $twigEnvironment;

    /**
     * @inheritdoc
     */
    public function render(NoticeInterface $notice)
    {
        echo $this->getTwigEnvironment()->render($this->getTemplate(), $this->getContext());
    }

    /**
     * @inheritdoc
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @inheritdoc
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @inheritdoc
     */
    public function setContext(array $context)
    {
        $this->context = $context;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTwigEnvironment()
    {
        return $this->twigEnvironment;
    }

    /**
     * @inheritdoc
     */
    public function setTwigEnvironment(\Twig_Environment $twigEnvironment)
    {
        $this->twigEnvironment = $twigEnvironment;
        return $this;
    }
}
