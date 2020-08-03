<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Notices;

/**
 * Class NoticeWarningView
 */
class NoticeWarningView extends NoticeView
{
    /**
     * @var array CSS classes.
     */
    protected $cssClasses = array('notice', 'notice-warning', 'wp-kit-notice', 'wp-kit-notice-warning');
}
