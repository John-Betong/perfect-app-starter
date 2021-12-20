<?php declare(strict_types=1);

namespace App\Core;

/**
 * Class Request
 * @package App\Core
 */
class Request
{
    /**
     * @return string
     */
    final public function uri(): string
    {
        if (strpos($_SERVER['REQUEST_URI'], '//') !== false)
        {
            http_response_code(400);
            die(view('/errors/400'));
        }

        $uri = trim($_SERVER['REQUEST_URI'], '/');
        return parse_url($uri, PHP_URL_PATH);
    }


    /**
     * @return string
     */
    final public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
