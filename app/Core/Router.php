<?php declare(strict_types=1);

namespace App\Core;

use BadMethodCallException;

/**
 * Class Router
 * @package App\Core
 */
class Router
{
    /**
     * @var string
     */
    private string $uri;

    /**
     * @var array
     */
    private array $routes = ['GET' => [], 'POST' => []];

    /**
     * Router constructor.
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    /**
     * @param string $action
     * @param string $controller
     */
    final public function get(string $action, string $controller): void
    {
        $this->routes['GET'][$action] = $controller;
    }

    /**
     * @param string $action
     * @param string $controller
     */
    final public function post(string $action, string $controller): void
    {
        $this->routes['POST'][$action] = $controller;
    }

    /**
     * @param string $requestType
     * @return int|null
     * FROM video: "Direct the traffic"
     */
    final public function directTraffic(string $requestType): ?int
    {
        if (!array_key_exists($this->uri, $this->routes[$requestType]))
        {
            http_response_code(404);
            die(view('/errors/404'));
        }
        return $this->callAction(...explode('@', $this->routes[$requestType][$this->uri]));
    }

    /**
     * @param string $controller
     * @param string $method
     * @return int|null
     */
    private function callAction(string $controller, string $method): ?int
    {
        $controller = "App\Http\Controllers\\$controller";
        $controller = new $controller($this->uri);
        if (!method_exists($controller, $method))
        {
            throw new BadMethodCallException ("Controller does not respond to the $method method call");
        }
        return $controller->$method();
    }
}
