<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use Elmittil\Dice\Dice;
use Elmittil\Dice\DiceHand;
use Elmittil\Dice\GraphicDice;

use function Mos\Functions\url;

// print_r($data["playersHand"]);
// echo print_r($_SESSION);
$header = $header ?? null;
// $playersHand = $data["playersHand"];

?>

<div class="game21-wrapper">
    <h1 class="game-title"><?= $header ?></h1>

    <form action="<?= url("/game21/set-hand") ?>" method="post" class="die-choice">
        <div class="radio-b">
            <input type="radio" id="1" name="diceQty" value="1">
            <label for="1">1 die</label><br>
            <input type="radio" id="2" name="diceQty" value="2">
            <label for="2">2 dice</label><br>
        </div>
        <button type="submit" class="new-game-button" name="start" value="Play">Play</button>
    </form>
</div>
