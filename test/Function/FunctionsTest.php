<?php

declare(strict_types=1);

namespace Mos\Functions;

use PHPUnit\Framework\TestCase;
use Elmittil\Dice\Dice;
use Elmittil\Dice\DiceHand;

/**
 * Test cases for the functions in src/functions.php.
 */
class FunctionsTest extends TestCase
{
    /**
     * Test the function getRoutePath().
     */
    public function testGetRoutePath()
    {
        $res = getRoutePath();
        $this->assertEmpty($res);
    }



    /**
     * Test the function renderView().
     */
    public function testRenderView()
    {
        $res = renderView("standard.php");
        $this->assertIsString($res);
    }



    /**
     * Test the function renderView().
     */
    public function testRenderTwigView()
    {
        $res = renderTwigView("index.html");
        $this->assertIsString($res);
    }



    /**
     * Test the function url().
     */
    public function testUrl()
    {
        $res = url("/");
        $this->assertIsString($res);
    }



    /**
     * Test the function getBaseUrl().
     */
    public function testGetBaseUrl()
    {
        $res = getBaseUrl();
        $this->assertIsString($res);
    }



    /**
     * Test the function getCurrentUrl().
     */
    public function testGetCurrentUrl()
    {
        $res = getCurrentUrl();
        $this->assertIsString($res);
    }



    /**
     * Test the function destroySession().
     * @runInSeparateProcess
     */
    public function testDestroySession()
    {
        session_start();

        $_SESSION = [
            "key" => "value"
        ];

        destroySession();
        $this->assertEmpty($_SESSION);
    }

     /**
     * Test the function ButtonRoll.
     * Empty session, 1 die
     *  Does it roll the dice?
     * Assert:
     *      increases the value of $_SESSION["total"]
     *      increases the value of $_SESSION["roll"]
     *
     */
    public function testButtonRollRollsDice()
    {
        $diceQty = 1;
        $_SESSION['roll'] = array(0, 0);
        $_SESSION['score'] = array();
        $_SESSION['total'] = array(0 , 0);
        $_SESSION['message'] = "";

        buttonRoll($diceQty);
        $this->assertTrue($_SESSION['total'][0] > 0);
        $this->assertTrue($_SESSION['roll'][0] > 0);
    }

    /**
     * Test the function ButtonRoll.
     * Empty session, 10 die (achieve $_SESSION["total"] > 21)
     *  Does it roll the dice and change the message?
     * Assert:
     *      $_SESSION["message"] contains "WON"
     *      increases the value of $_SESSION["total"]
     *      increases the value of $_SESSION["roll"]
     *      $_SESSION["score"] contains an entry "x" (WIN)
     */
    public function testButtonRollWinningMessage()
    {
        $diceQty = 10;
        $_SESSION['roll'] = array(0, 0);
        $_SESSION['score'] = array();
        $_SESSION['total'] = array(0 , 0);
        $_SESSION['message'] = "";

        buttonRoll($diceQty);

        $this->assertStringContainsString("WON", $_SESSION['message']);
        $this->assertTrue($_SESSION['total'][0] > 0);
        $this->assertTrue($_SESSION['roll'][0] > 0);
        $this->assertContains("x", $_SESSION['score'][0]);
    }


    /**
     * Test the function ButtonRoll for PLAYER WIN.
     * Session contains a losing score for computer, 1 die
     * (achieve $_SESSION["total"][1] > 21)
     * Assert:
     *      $_SESSION["message"] contains "WON"
     *      increases the value of $_SESSION["total"]
     *      increases the value of $_SESSION["roll"]
     *      $_SESSION["message"] contains an entry "YOU" (player WIN)
     */
    public function testButtonRollPlayerWins()
    {
        $diceQty = 1;
        $_SESSION['roll'] = array(0, 0);
        $_SESSION['score'] = array();
        $_SESSION['total'] = [
            0 => 0,
            1 => 22
        ];
        $_SESSION['message'] = "";

        buttonRoll($diceQty);
        $this->assertStringContainsString("YOU", $_SESSION['message']);
    }

    /**
     * Test the function ButtonPass for COMPUTER WIN.
     * Session contains a empty score, 1 die
     * Assert:
     *      $_SESSION['total'][1] > 0
     *      $_SESSION['roll'][1] > 0
     *      $_SESSION['message'] contains "WON"
     *      $_SESSION['score'][0] (player) contains "" (lost)
     */
    public function testButtonPassPlayerWins()
    {
        $diceQty = 1;
        $_SESSION['roll'] = array(0, 0);
        $_SESSION['score'] = array();
        $_SESSION['total'] = [
            0 => 0,
            1 => 0
        ];
        $_SESSION['message'] = "";

        buttonPass($diceQty);
        $this->assertStringContainsString("WON", $_SESSION['message']);
        $this->assertTrue($_SESSION['total'][1] > 0);
        $this->assertTrue($_SESSION['roll'][1] > 0);
        $this->assertContains("x", $_SESSION['score'][0]);
    }

    /**
     * Test the function ButtonPass for PLAYER WIN.
     * Session contains a empty score, 1 die
     * Assert:
     *      $_SESSION['total'][1] > 0
     *      $_SESSION['roll'][1] > 0
     *      $_SESSION['message'] contains "WON"
     *      $_SESSION['score'][0] (player) contains "" (lost)
     */
    public function testButtonPassPlayerWinsFakeScore()
    {
        $diceQty = 1;
        $_SESSION['roll'] = array(0, 0);
        $_SESSION['score'] = array();
        $_SESSION['total'] = [
            0 => 22,
            1 => 23
        ];
        $_SESSION['message'] = "";

        buttonPass($diceQty);
        $this->assertContains("x", $_SESSION['score'][0]);
    }

      /**
     * Test the function ButtonRoll for COMPUTER WIN WITH 21.
     * Session contains a empty score, 1 die
     * Assert:
     *      $_SESSION['message'] contains "COMPUTER"
     */
    public function testButtonRollComputerWinsWith21()
    {
        $diceQty = 1;
        $_SESSION['roll'] = array(0, 0);
        $_SESSION['score'] = array();
        $_SESSION['total'] = [
            0 => 10,
            1 => 21
        ];
        $_SESSION['message'] = "";

        buttonRoll($diceQty);
        $this->assertStringContainsString("COMPUTER", $_SESSION['message']);
    }
}
