<?php

declare(strict_types=1);

namespace Mos\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Elmittil\Yatzee\ScoreChart;

use function Mos\Functions\{
    destroySession
};

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

    // /**
    //  * Check that the controller returns a response with
    //  * play() no session['chart'] 
    //  */
    // public function testControllerReturnsResponsePlayNoSessionChart()
    // {
    //     $_SESSION = [
    //         "rolledValues" => [1, 2, 3, 4, 5],
    //         "rollsLeft" => 2
    //     ];
    //     $controller = new Yatzee();


    //     $exp = "\Psr\Http\Message\ResponseInterface";
    //     $res = $controller->play();
    //     $this->assertInstanceOf($exp, $res);
    // }

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
        $_POST['selectedScore'] = [3 => 9];

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->score();
        $this->assertInstanceOf($exp, $res);
        unset($_POST['selectedScore']);
    }

    /**
     * Check that the controller returns a response with
     * RecordScore().
     */
    public function testControllerReturnsResponseRecordScore()
    {
        $_SESSION = $this->sessionSetup();
        $controller = new Yatzee();
        $_SESSION['possibleScores'] = array();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->recordScore();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response with
     * scores with selected radio button
     */
    public function testControllerRecorsScoreWithSelectedRadioButton()
    {
        $_SESSION = $this->sessionSetup();
        $controller = new Yatzee();
        $_POST['selectedScore'] = "3";
        $_SESSION['possibleScores'] = array("3" => 9);

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->recordScore();
        $this->assertInstanceOf($exp, $res);
        $exp = 9;
        $this->assertEquals($exp, $_SESSION['chart']["3"]);
        unset($_POST['selectedScore']);
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

    /**
     * Check that the controller creates $_SESSION['rolledValues'] when .
     */
    public function testControllerCreatesSessionRolledValues()
    {
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
            "chart" => $chartArray,
            "rollsLeft" => 2
        ];
        $controller = new Yatzee();

        $exp = "rolledValues";
        $controller->play();
        $this->assertArrayHasKey($exp, $_SESSION);
    }


    /**
     * Check that the controller returns a response with
     * RecordScore() and .
     */
    public function testRerollSelectedDice()
    {
        $_POST['selectedDice'] = [1, 2, 3];
        $_SESSION = $this->sessionSetup();

        $exp = "rolledValues";
        $this->assertArrayHasKey($exp, $_SESSION);
        $this->assertIsArray($_SESSION["rolledValues"]);
    }


    private function sessionSetup()
    {
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
