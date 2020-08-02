<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Notices;

/**
 * Class NoticesStack
 */
class NoticesStack implements NoticesStackInterface
{
    /**
     * @var NoticeInterface[]
     */
    protected $notices = array();

    /**
     * @inheritdoc
     */
    public function getNotices()
    {
        return $this->notices;
    }

    /**
     * @inheritdoc
     */
    public function setNotices(array $notices)
    {
        $this->notices = $notices;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addNotice(NoticeInterface $notice)
    {
        $this->notices[] = $notice;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function removeNoticeByName($name)
    {
        $notices = $this->notices;

        foreach ($notices as $noticeKey => $noticeInstance) {
            if ($noticeInstance->getName() === $name) {
                unset($notices[$noticeKey]);
            }
        }

        if ($notices !== $this->notices) {
            $this->notices = $notices;
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function removeNoticeByClassName($className)
    {
        $notices = $this->notices;

        foreach ($notices as $noticeKey => $noticeInstance) {
            if (get_class($noticeInstance) === $className) {
                unset($notices[$noticeKey]);
            }
        }

        if ($notices !== $this->notices) {
            $this->notices = $notices;
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        foreach ($this->notices as $notice) {
            if ($notice->isRelevant()) {
                $notice->lateConstruct();
                $notice->render();
            }
        }
    }
}
