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

// print_r($data["playersHand"]);
var_dump($_SESSION);
$header = $header ?? null;
// $playersHand = $data["playersHand"];

?>

<h1><?= $header ?></h1>

<?php
if (array_key_exists('button1', $_POST)) {
    buttonRoll();
} else if (array_key_exists('button2', $_POST)) {
    buttonPass();
}

if ($_SESSION['message'] == ""){ ?>
    <form method="post">
        <input type="submit" name="button1"
                class="button" value="Roll" />
            
        <input type="submit" name="button2"
                class="button" value="Pass" />
    </form>
<? } ?>

<h1 style="color: red;"><?= $_SESSION['message'] ?></h1>
<p id="sum ">You rolled : <?= $_SESSION['roll'][0] ?> Total: <?= $_SESSION['total'][0] ?></p>


<p>Computer rolled: <?= $_SESSION['roll'][1] ?> Total: <?= $_SESSION['total'][1] ?></p>

<p>The score is: </p> 
<table>
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
<p><a href='<?= url('/game21')?>'><input type='submit' value='RESET SCORE / PLAY NEW GAME'/></a></p>




