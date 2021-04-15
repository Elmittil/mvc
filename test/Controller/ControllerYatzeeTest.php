<?php

declare(strict_types=1);

namespace Mos\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Elmittil\Yatzee\ScoreChart;

use function Mos\Functions\{
    destroySession
};

require INSTALL_PATH . "/vendor/autoload.php";

/**
 * Test cases for the controller Session.
 */
class ControllerYatzeeTest extends TestCase
{
    
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Yatzee();
        $this->assertInstanceOf("\Mos\Controller\Yatzee", $controller);
    }

    /**
     * Check that the controller returns a response with 
     * intro().
     */
    public function testControllerReturnsResponseIntro()
    {
        $controller = new Yatzee();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->intro();
        $this->assertInstanceOf($exp, $res);
    }

     /**
     * Check that the controller returns a response with 
     * play().
     */
    public function testControllerReturnsResponsePlay()
    {
        $_SESSION = $this->sessionSetup();
        $controller = new Yatzee();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->play();
        $this->assertInstanceOf($exp, $res);
    }

     /**
     * Check that the controller returns a response with 
     * reroll().
     */
    public function testControllerReturnsResponseReroll()
    {
        $_SESSION = $this->sessionSetup();
        $controller = new Yatzee();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->reroll();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response with 
     * score().
     */
    public function testControllerReturnsResponseScore()
    {
        $_SESSION = $this->sessionSetup();
        $controller = new Yatzee();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->score();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response with 
     * RecordScore().
     */
    public function testControllerReturnsResponseRecordScore()
    {
        $_SESSION = $this->sessionSetup();
        $controller = new Yatzee();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->recordScore();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response with 
     * GameOver().
     */
    public function testControllerReturnsResponseGameOver()
    {
        $controller = new Yatzee();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->gameOver();
        $this->assertInstanceOf($exp, $res);
    }

    private function sessionSetup(){
        $newChart = new ScoreChart();
        $chartArray = 
        [
            "1" => null,
            "2" => null,
            "3" => null,
            "4" => null,
            "5" => null,
            "6" => null,
            "Bonus" => 0,
            "Total" => 0,
            "playsLeft" => 6
        ];
        $_SESSION = [
            "rolledValues" => [1, 2, 3, 4, 5],
            "chart" => $chartArray,
            "rollsLeft" => 2
        ];
        return $_SESSION;
    }
}
