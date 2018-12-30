<?php
namespace Korobochkin\WPKit\Tests\Utils;

use Korobochkin\WPKit\Utils\RequestFactory;
use Symfony\Component\HttpFoundation\Request;

class RequestFactoryTest extends \WP_UnitTestCase
{
    public function testCreate()
    {
        $request = RequestFactory::create();
        $this->assertInstanceOf(Request::class, $request);
        var_dump($_GET, $_POST, $_COOKIE, $_SERVER);
    }
}
