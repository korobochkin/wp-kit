<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Notices;

/**
 * Class NoticeInfoView
 */
class NoticeInfoView extends NoticeView
{
    /**
     * @var array CSS classes.
     */
    protected $cssClasses = array('notice', 'notice-info', 'wp-kit-notice', 'wp-kit-notice-info');
}
