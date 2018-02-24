<?php
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

        $cssClasses = implode(' ', $this->cssClasses);

        printf(
            '<div class="%1$s">%2$s</div>',
            esc_attr($cssClasses),
            $title . $notice->getContent()
        );
    }

    protected function prepareCssClasses()
    {
        $classes = $this->cssClasses;

        if ($this->notice->isDismissible()) {
            $classes[] = 'is-dismissible';
        }

        $classes[] = 'wp-kit-notice-' . $this->notice->getName();

        $this->cssClasses = $classes;
    }
}
