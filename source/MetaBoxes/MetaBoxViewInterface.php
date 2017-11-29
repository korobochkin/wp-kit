<?php
namespace Korobochkin\WPKit\MetaBoxes;

/**
 * Interface MetaBoxViewInterface
 */
interface MetaBoxViewInterface
{
    /**
     * Output HTML markup for Meta Box.
     *
     * @param MetaBoxInterface $metaBox Meta box instance.
     */
    public function render(MetaBoxInterface $metaBox);

    /**
     * Returns template name (path).
     *
     * @return string Template.
     */
    public function getTemplate();

    /**
     * Sets template name (path).
     *
     * @param string $template name or path to template.
     *
     * @return $this For chain calls.
     */
    public function setTemplate($template);

    /**
     * Returns values (variables) for templates.
     *
     * @return array Values for View instance.
     */
    public function getContext();

    /**
     * Sets values (variables) for templates.
     *
     * @param array $context Values for View instance.
     *
     * @return $this For chain calls.
     */
    public function setContext(array $context);

    /**
     * Returns Twig.
     *
     * If you use Twig for rendering this method would helpful.
     *
     * @return \Twig_Environment Twig.
     */
    public function getTwigEnvironment();

    /**
     * Sets Twig.
     *
     * If you use Twig for rendering this method would helpful.
     *
     * @param \Twig_Environment $twigEnvironment Twig.
     *
     * @return $this For chain calls.
     */
    public function setTwigEnvironment($twigEnvironment);
}
