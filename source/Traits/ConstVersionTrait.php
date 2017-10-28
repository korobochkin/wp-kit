<?php
namespace Korobochkin\WPKit\Traits;

trait ConstVersionTrait
{
    public function getVersion()
    {
        return constant(array(__CLASS__, 'VERSION'));
    }
}
