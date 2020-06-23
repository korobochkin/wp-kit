<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Notices;

class NoticeErrorView extends NoticeView
{
    /**
     * @var array CSS classes.
     */
    protected $cssClasses = array('notice', 'notice-error', 'wp-kit-notice', 'wp-kit-notice-error');
}
