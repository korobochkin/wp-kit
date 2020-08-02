<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Notices;

/**
 * Class NoticeView
 */
class NoticeView implements NoticeViewInterface
{
    /**
     * @var NoticeInterface
     */
    protected $notice;

    /**
     * @var array
     */
    protected $cssClasses = array('notice', 'wp-kit-notice');

    /**
     * @inheritdoc
     */
    public function render(NoticeInterface $notice)
    {
        $this->notice = $notice;
        $this->prepareCssClasses();

        if ($notice->getTitle()) {
            $title = '<p class="notice-title">' . $notice->getTitle() . '</p>';
        } else {
            $title = '';
        }

        $id = 'wp-kit-notice-' . $notice->getName();

        $cssClasses = implode(' ', $this->cssClasses);

        printf(
            '<div id="%1$s" class="%2$s">%3$s</div>',
            esc_attr($id),
            esc_attr($cssClasses),
            $title . $notice->getContent()
        );
    }

    /**
     * @return $this For chain calls.
     */
    protected function prepareCssClasses()
    {
        $classes = $this->cssClasses;

        if ($this->notice->isDismissible()) {
            $classes[] = 'is-dismissible';
        }

        $classes[] = 'wp-kit-notice-' . $this->notice->getName();

        $this->cssClasses = $classes;

        return $this;
    }

    /**
     * Returns list of CSS classes.
     *
     * @return array List of CSS classes.
     */
    public function getCssClasses()
    {
        return $this->cssClasses;
    }

    /**
     * Sets list of CSS classes.
     *
     * @param array $cssClasses List of CSS classes.
     *
     * @return $this For chain calls.
     */
    public function setCssClasses(array $cssClasses)
    {
        $this->cssClasses = $cssClasses;
        return $this;
    }
}
