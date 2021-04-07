<?php

declare(strict_types=1);

namespace Mos\Router;

use Elmittil\Dice\DiceHand;

use function Mos\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url,
    resetGame
};

/**
 * Class Router.
 */
class Router
{
    public static function dispatch(string $method, string $path): void
    {
        if ($method === "GET" && $path === "/") {
            $data = [
                "header" => "Index page",
                "message" => "Hello, this is the index page, rendered as a layout.",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session") {
            $body = renderView("layout/session.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session/destroy") {
            destroySession();
            redirectTo(url("/session"));
            return;
        } else if ($method === "GET" && $path === "/debug") {
            $body = renderView("layout/debug.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/twig") {
            $data = [
                "header" => "Twig page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderTwigView("index.html", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/some/where") {
            $data = [
                "header" => "Rainbow page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/dice") {
            $data = [
                "header" => "Dice",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderView("layout/dice.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/game21") {
            $data = [
                "header" => "GAME 21",
                "spec_message" => "hi anya"
            ];

            $playerRolls = 0;
            $computerRolls = 0;
            $_SESSION['roll'] = array($playerRolls, $computerRolls);
            $_SESSION['score'] = array();
            $_SESSION['total'] = array(0 , 0);
            $_SESSION['message'] = "";
            $body = renderView("layout/game21.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/game21/set-hand") {
            $diceQty = (int)$_POST['diceQty'] ?? 1;
            $_SESSION['diceQty'] = $diceQty;

            redirectTo(url("/game21/play"));
            return;
        } else if ($method === "GET" && $path === "/game21/reset") {
            resetGame();
            redirectTo(url("/game21/play"));
            return;
        } else if ($method === "GET" && $path === "/game21/play") {
            $data = [
                "header" => "GAME 21",
            ];
            $body = renderView("layout/play.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/game21/play") {
            $data = [
                "header" => "GAME 21"
            ];
            $body = renderView("layout/play.php", $data);
            sendResponse($body);
            return;
        }

        $data = [
            "header" => "404",
            "message" => "The page you are requesting is not here. You may also checkout the HTTP response code, it should be 404.",
        ];
        $body = renderView("layout/page.php", $data);
        sendResponse($body, 404);
    }
}
