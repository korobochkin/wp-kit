<?php
namespace Korobochkin\WPKit\Tests\Utils;

use Korobochkin\WPKit\Utils\RequestFactory;
use Symfony\Component\HttpFoundation\Request;

class RequestFactoryTest extends \WP_UnitTestCase
{
    public function testCreate()
    {
        $request = new RequestFactory();
        $this->assertTrue(is_a($request, Request::class));
    }
}
