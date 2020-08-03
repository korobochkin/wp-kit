<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits;

trait TermIdTrait
{
    /**
     * @var int Unique Term ID.
     */
    protected $termId;

    /**
     * Returns the term ID.
     *
     * @return int Post ID.
     */
    public function getTermId()
    {
        return $this->termId;
    }

    /**
     * Set the term ID.
     *
     * @param int $id
     *
     * @return $this For chain calls.
     */
    public function setTermId($id)
    {
        $this->termId = $id;

        return $this;
    }
}
