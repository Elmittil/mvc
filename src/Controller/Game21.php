<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\{
    renderView,
    redirectTo,
    url,
    resetGame
};

/**
 * Controller for the index route.
 */
class Game21 extends ControllerBase
{
    public function game21start(): ResponseInterface
    {
        $data = [
            "header" => "Game21",
        ];

        $playerRolls = 0;
        $computerRolls = 0;
        $_SESSION['roll'] = array($playerRolls, $computerRolls);
        $_SESSION['score'] = array();
        $_SESSION['total'] = array(0 , 0);
        $_SESSION['message'] = "";
        $body = renderView("layout/game21.php", $data);

        return $this->response($body);
    }

    public function game21play(): ResponseInterface
    {
        $data = [
            "header" => "GAME 21",
        ];

        $body = renderView("layout/play.php", $data);

        return $this->response($body);
    }

    public function game21sethand(): ResponseInterface
    {
        $diceQty = (int)$_POST['diceQty'] ?? 1;
        $_SESSION['diceQty'] = $diceQty;
        
        redirectTo(url("/game21/play"));
    }

    public function game21reset(): ResponseInterface
    {
        resetGame();
        
        redirectTo(url("/game21/play"));
    }
  
}
