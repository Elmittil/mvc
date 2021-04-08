<?php

/**
 * Load the routes into the router, this file is included from
 * `htdocs/index.php` during the bootstrapping to prepare for the request to
 * be handled.
 */

declare(strict_types=1);

use FastRoute\RouteCollector;

$router->addRoute("GET", "/test", function () {
    // A quick and dirty way to test the router or the request.
    return "Testing response";
});

$router->addRoute("GET", "/", "\Mos\Controller\Index");
$router->addRoute("GET", "/debug", "\Mos\Controller\Debug");
$router->addRoute("GET", "/twig", "\Mos\Controller\TwigView");

$router->addGroup("/session", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Mos\Controller\Session", "index"]);
    $router->addRoute("GET", "/destroy", ["\Mos\Controller\Session", "destroy"]);
});

$router->addGroup("/some", function (RouteCollector $router) {
    $router->addRoute("GET", "/where", ["\Mos\Controller\Sample", "where"]);
});

$router->addGroup("/game21", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Mos\Controller\Game21", "game21start"]);
    $router->addRoute("POST", "/set-hand", ["\Mos\Controller\Game21", "game21sethand"]);
    $router->addRoute("GET", "/reset", ["\Mos\Controller\Game21", "game21reset"]);
    $router->addRoute("GET", "/play", ["\Mos\Controller\Game21", "game21play"]);
    $router->addRoute("POST", "/play", ["\Mos\Controller\Game21", "game21play"]);
});

$router->addRoute("GET", "/dice", "\Mos\Controller\Dice");

$router->addGroup("/yatzy", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Mos\Controller\Yatzy", "intro"]);
});
