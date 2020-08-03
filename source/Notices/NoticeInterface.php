<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Notices;

use Korobochkin\WPKit\DataComponents\NodeInterface;

/**
 * Interface NoticeInterface
 */
interface NoticeInterface
{
    /**
     * Call for late construct init.
     *
     * @return $this
     */
    public function lateConstruct();

    /**
     * @return string Name of notice.
     */
    public function getName();

    /**
     * @param $name string Name of notice.
     *
     * @return $this For chain calls.
     */
    public function setName($name);

    /**
     * @return string title of notice.
     */
    public function getTitle();

    /**
     * @param $title string Title of notice.
     *
     * @return $this
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getContent();

    /**
     * @param $content string
     *
     * @return $this
     */
    public function setContent($content);

    /**
     * @return boolean True if dismissible.
     */
    public function isDismissible();

    /**
     * @param $dismissible boolean True if dismissible
     *
     * @return $this For chain calls.
     */
    public function setDismissible($dismissible);

    /**
     * Disable notice with Relevant Storage.
     *
     * @return $this
     */
    public function disable();

    /**
     * Enable notice with Relevant Storage.
     *
     * @return $this
     */
    public function enable();

    /**
     * @return NodeInterface
     */
    public function getRelevantStorage();

    /**
     * @param $storage NodeInterface
     *
     * @return $this
     */
    public function setRelevantStorage(NodeInterface $storage);

    /**
     * Decides should notice rendered or not.
     *
     * @return boolean True if notice need to be rendered.
     */
    public function isRelevant();

    /**
     * @return NoticeViewInterface
     */
    public function getView();

    /**
     * @param $view NoticeViewInterface
     *
     * @return $this
     */
    public function setView(NoticeViewInterface $view);

    /**
     * Render notice with view.
     */
    public function render();
}
