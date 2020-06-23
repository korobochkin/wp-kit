<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\DataComponents\Traits;

trait ExpirationTrait
{
    /**
     * @var int Number of seconds to keep the data before refreshing.
     */
    protected $expiration = 1;

    /**
     * Return number of seconds after which value will expire.
     *
     * @return int Expiration in seconds.
     */
    public function getExpiration()
    {
        return $this->expiration;
    }

    /**
     * Set number of seconds after which value will expire.
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
