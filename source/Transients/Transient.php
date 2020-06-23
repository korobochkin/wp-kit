<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Transients;

use Korobochkin\WPKit\DataComponents\Traits\DummyBuildConstraintTrait;

/**
 * Class Transient
 * @package Korobochkin\WPKit\Transients
 */
class Transient extends AbstractTransient
{
    use DummyBuildConstraintTrait;
}
