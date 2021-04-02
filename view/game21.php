<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);
use function Mos\Functions\url;
use \Elmittil\Dice\Dice;
use \Elmittil\Dice\DiceHand;
use \Elmittil\Dice\GraphicDice;

// print_r($data["playersHand"]);
echo print_r($_SESSION);
$header = $header ?? null;
// $playersHand = $data["playersHand"];

?>

<h1><?= $header ?></h1>

<form action="<?= url("/game21/set-hand") ?>" method="post">
    <input type="radio" id="1" name="diceQty" value="1">
    <label for="1">1 die</label><br>
    <input type="radio" id="2" name="diceQty" value="2">
    <label for="2">2 dice</label><br>

    <button type="submit" name="start" value="Play">Play</button>
</form>



