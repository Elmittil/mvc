<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use \Elmittil\Dice\Dice;
use \Elmittil\Dice\DiceHand;
use \Elmittil\Dice\GraphicDice;


$header = $header ?? null;

$sides = 6;
$die = new Dice($sides);
$die->roll();

$diceQty = 4;
$diceHand = new DiceHand($diceQty);
$diceHand->roll($diceQty);

$graphicDie = new GraphicDice($sides);
$graphicDie->roll();
?>

<h1><?= $header ?></h1>



