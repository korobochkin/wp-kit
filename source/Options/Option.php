<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Options;

use Korobochkin\WPKit\DataComponents\Traits\DummyBuildConstraintTrait;

/**
 * This class can be used for dynamic options (from other plugins or for managing default WP options).
 */
class Option extends AbstractOption
{

    use DummyBuildConstraintTrait;
}
