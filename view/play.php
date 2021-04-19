<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use Elmittil\Dice\Dice;
use Elmittil\Dice\DiceHand;
use Elmittil\Dice\GraphicDice;

use function Mos\Functions\{
    url,
    buttonRoll,
    buttonPass
};

$header = $header ?? null;
$diceQty =  $_SESSION['diceQty'];

?>
<div class="game21-wrapper">
    <h1 class="game-title"><?= $header ?></h1>

    <?php
    if (array_key_exists('button1', $_POST)) {
            buttonRoll((int)$diceQty);
    } else if (array_key_exists('button2', $_POST)) {
            buttonPass((int)$diceQty);
    }

    if ($_SESSION['message'] == "") { ?>
        <form method="post"class="play-panel">
            <input type="submit" name="button1"
                    class="roll-button" value="Roll" />

            <input type="submit" name="button2"
                    class="roll-button" value="Pass" />
        </form>
    <?php } ?>

    <div class="game-score">
        <h1 style="color: red;"><?= $_SESSION['message'] ?></h1>
        <p id="sum ">You rolled : <?= $_SESSION['roll'][0] ?> Total: <?= $_SESSION['total'][0] ?></p>


        <p>Computer rolled: <?= $_SESSION['roll'][1] ?> Total: <?= $_SESSION['total'][1] ?></p>

        <table class="rounds">
            <tr>
                <th>You</th>
                <th>Computer</th>
            </tr>
            <?php foreach ($_SESSION['score'] as $score) : ?>
                <tr>
                    <td><?= $score[0]?></td>
                    <td><?= $score[1] ?></td>
                </tr>
            <?php endforeach ?>
        </table>

    </div>

    <p>
        <a href='<?= url('/game21')?>'>
            <input type='submit' class="new-game-button" value='RESET SCORE / PLAY NEW GAME'/>
        </a>
    </p>

</div>
