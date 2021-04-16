<?php

declare(strict_types=1);

namespace Mos\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Session.
 */
class ControllerGame21Test extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Game21();
        $this->assertInstanceOf("\Mos\Controller\Game21", $controller);
    }

    /**
     * Check that the controller returns a response with 
     * game21start().
     */
    public function testControllerReturnsResponseStart()
    {
        $controller = new Game21();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->game21start();
        $this->assertInstanceOf($exp, $res);
    }

     /**
     * Check that the controller returns a response with 
     * game21play().
     */
    public function testControllerReturnsResponsePlay()
    {
        $controller = new Game21();
        $_SESSION['diceQty'] = 2;

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->game21play();
        $this->assertInstanceOf($exp, $res);
    }

     /**
     * Check that the controller returns a response with 
     * game21reset().
     */
    public function testControllerReturnsResponseReset()
    {
        $controller = new Game21();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->game21reset();
        $this->assertInstanceOf($exp, $res);
    }

    // /**
    //  * Check that the controller returns a response with 
    //  * game21setHand().
    //  */
    // public function testControllerReturnsResponseSetHand()
    // {
    //     $controller = new Game21();

    //     $exp = "\Psr\Http\Message\ResponseInterface";
    //     $res = $controller->game21setHand();
    //     $this->assertInstanceOf($exp, $res);
    // }
}
