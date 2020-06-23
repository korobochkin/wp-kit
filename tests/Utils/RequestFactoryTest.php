<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Utils;

use Korobochkin\WPKit\Utils\RequestFactory;
use Symfony\Component\HttpFoundation\FileBag;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ServerBag;

class RequestFactoryTest extends \WP_UnitTestCase
{
    public function testCreate()
    {
        $request = RequestFactory::create();
        $this->assertInstanceOf(Request::class, $request);

        $this->assertEquals(new ParameterBag(), $request->query);
        $this->assertEquals(new ParameterBag(), $request->request);
        $this->assertEquals(new ParameterBag(), $request->attributes);
        $this->assertEquals(new ParameterBag(), $request->cookies);
        $this->assertEquals(new FileBag(), $request->files);
    }

    /**
     * @dataProvider provideOverloadedMethods
     * @param string Http method.
     */
    public function testCreateFromGlobals($method)
    {
        $normalizedMethod = strtoupper($method);

        $_GET['foo1']    = 'bar1';
        $_POST['foo2']   = 'bar2';
        $_COOKIE['foo3'] = 'bar3';
        $_FILES['foo4']  = array('bar4');
        $_SERVER['foo5'] = 'bar5';

        $request = RequestFactory::create();
        $this->assertEquals('bar1', $request->query->get('foo1'), '::fromGlobals() uses values from $_GET');
        $this->assertEquals('bar2', $request->request->get('foo2'), '::fromGlobals() uses values from $_POST');
        $this->assertEquals('bar3', $request->cookies->get('foo3'), '::fromGlobals() uses values from $_COOKIE');
        $this->assertEquals(array('bar4'), $request->files->get('foo4'), '::fromGlobals() uses values from $_FILES');
        $this->assertEquals('bar5', $request->server->get('foo5'), '::fromGlobals() uses values from $_SERVER');

        unset($_GET['foo1'], $_POST['foo2'], $_COOKIE['foo3'], $_FILES['foo4'], $_SERVER['foo5']);

        $_SERVER['REQUEST_METHOD'] = $method;
        $_SERVER['CONTENT_TYPE']   = 'application/x-www-form-urlencoded';
        $request                   = RequestContentProxy::createFromGlobals();
        $this->assertEquals($normalizedMethod, $request->getMethod());
        $this->assertEquals('mycontent', $request->request->get('content'));

        unset($_SERVER['REQUEST_METHOD'], $_SERVER['CONTENT_TYPE']);
    }

    public function provideOverloadedMethods()
    {
        return array(
            array('PUT'),
            array('DELETE'),
            array('PATCH'),
            array('put'),
            array('delete'),
            array('patch'),
        );
    }
}
