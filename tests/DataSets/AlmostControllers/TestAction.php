<?php
namespace Korobochkin\WPKit\Tests\DataSets\AlmostControllers;

use Korobochkin\WPKit\AlmostControllers\AbstractAction;

/**
 * Class TestAction
 */
class TestAction extends AbstractAction
{
    /**
     * TestAction constructor.
     */
    public function __construct()
    {
        $this->setName(self::class);
    }

    /**
     * @inheritdoc
     */
    public function handleRequest()
    {
        return $this;
    }
}
