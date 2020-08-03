<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Notices;

use Twig\Environment;

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
     * @var Environment Twig.
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
    public function setTwigEnvironment(Environment $twigEnvironment)
    {
        $this->twigEnvironment = $twigEnvironment;
        return $this;
    }
}
