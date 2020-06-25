<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Utils;

use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestFactory
 */
class RequestFactory
{

    /**
     * Returns HTTP request instance.
     *
     * @see wp_magic_quotes
     * @see stripslashes_deep
     *
     * @return Request HTTP request.
     */
    public static function create()
    {
        $get    = stripslashes_deep($_GET);
        $post   = stripslashes_deep($_POST);
        $cookie = stripslashes_deep($_COOKIE);
        $server = stripslashes_deep($_SERVER);

        $request = new Request($get, $post, array(), $cookie, $_FILES, $server);

        if ($request->headers->has('CONTENT_TYPE')
            && 0 === strpos($request->headers->get('CONTENT_TYPE'), 'application/x-www-form-urlencoded')
            && in_array(strtoupper($request->server->get('REQUEST_METHOD', 'GET')), array('PUT', 'DELETE', 'PATCH'))
        ) {
            parse_str($request->getContent(), $data);
            $request->request = new ParameterBag($data);
        }

        return $request;
    }
}
