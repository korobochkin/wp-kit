<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Notices;

/**
 * Interface NoticesStackInterface
 */
interface NoticesStackInterface
{
    /**
     * @return NoticeInterface[]
     */
    public function getNotices();

    /**
     * @param NoticeInterface[] $notices
     *
     * @return $this
     */
    public function setNotices(array $notices);

    /**
     * @param NoticeInterface $notice
     *
     * @return $this
     */
    public function addNotice(NoticeInterface $notice);

    /**
     * Removes all notices with passed name.
     *
     * @param $name string Name of notice to remove.
     *
     * @return $this
     */
    public function removeNoticeByName($name);

    /**
     * Removes all notices with passed class name.
     *
     * @param $className string Class name of notice to remove.
     *
     * @return $this
     */
    public function removeNoticeByClassName($className);

    /**
     * Render notices.
     */
    public function run();
}
