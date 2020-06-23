<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Notices;

/**
 * Class NoticeSuccessView
 */
class NoticeSuccessView extends NoticeView
{
    /**
     * @var array CSS classes.
     */
    protected $cssClasses = array('notice', 'notice-success', 'wp-kit-notice', 'wp-kit-notice-success');
}
