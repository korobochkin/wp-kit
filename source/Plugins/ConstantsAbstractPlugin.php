<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Plugins;

use Korobochkin\WPKit\Traits;

/**
 * Class ConstantsAbstractPlugin
 * @package Korobochkin\WPKit\Plugins
 */
abstract class ConstantsAbstractPlugin extends AbstractPlugin
{
    use Traits\ConstVersionTrait;

    use Traits\ConstNameTrait;
}
