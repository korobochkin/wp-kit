<?php
namespace Korobochkin\WPKit\DataComponents\Traits;

trait ExpirationTrait
{
    /**
     * @var int The maximum of seconds to keep the data before refreshing.
     */
    protected $expiration;

    /**
     * Get current value of expiration.
     *
     * @return int Expiration in seconds.
     */
    public function getExpiration()
    {
        return $this->expiration;
    }

    /**
     * Set the expiration.
     *
     * @param int $expiration
     *
     * @return $this For chain calls.
     */
    public function setExpiration($expiration)
    {
        $this->expiration = $expiration;

        return $this;
    }
}
