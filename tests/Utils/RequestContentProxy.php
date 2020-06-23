<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Tests\Utils;

use Symfony\Component\HttpFoundation\Request;

class RequestContentProxy extends Request
{
    public function getContent($asResource = false)
    {
        return http_build_query(array('_method' => 'PUT', 'content' => 'mycontent'));
    }
}
