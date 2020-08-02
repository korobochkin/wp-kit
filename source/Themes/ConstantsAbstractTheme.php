<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Themes;

use Korobochkin\WPKit\Traits;

/**
 * Class ConstantsAbstractTheme
 * @package Korobochkin\WPKit\Themes
 */
abstract class ConstantsAbstractTheme extends AbstractTheme
{
    use Traits\ConstVersionTrait;

    use Traits\ConstNameTrait;
}
