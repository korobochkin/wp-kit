<?php
namespace Korobochkin\WPKit\Traits;

trait ConstNameTrait
{
    public function getName()
    {
        return constant(array(__CLASS__, 'NAME'));
    }
}
