<?php

declare(strict_types=1);

// namespace Mos\Config;

use PHPUnit\Framework\TestCase;

// use Laminas\HttpHandlerRunner\Emitter\SapiEmitter as Emitter;
// use Mos\Controller\Error;
// use Psr\Http\Message\ResponseInterface;

// use function Mos\Functions\getRoutePath;

/**
 * Test cases for the configuration file bootstrap.php.
 */
class ConfigRouteTest extends TestCase
{
    public function testRoutes()
    {
    /**
     * Router
     *
     * Extract the path and route it to its handler.
     */
        $method = "GET";
        $path   = "/";

    // Load the routes from the configuration file
        $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) {
            require INSTALL_PATH . "/config/router.php";
        });

        $routeInfo = $dispatcher->dispatch($method, $path);
        $exp = FastRoute\Dispatcher::FOUND;
        $this->assertEquals($exp, $routeInfo[0]);
    }
}
