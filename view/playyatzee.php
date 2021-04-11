<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\{
    url,
    buttonRoll,
    buttonPass
};

$header = $header ?? null;
$n = 1;
$chartArray = $_SESSION['chart']->getScoreChart();

?>
<div class="game21-wrapper">
    <h1 class="game-title"><?= $header ?></h1>

    <? if ($chartArray["playsLeft"] > 0) {?>

        <form method="POST" class="diceBox" action="<?= url("/yatzee/re-roll") ?>">

            <? foreach ($_SESSION['rolledValues'] as $dieface)
            { ?>
                <input type="checkbox" name="selectedDice[]" id="die<?= $n ?>" value=<?= $n ?> />
                <label name="selectedDice[]" for="die<?= $n ?>">
                    <img src="../img/dice-<?= $dieface ?>.png" alt="die<?= $dieface ?>">
                </label>
                <? 
                $n++;
            } ?>

            <div class="rerolls-section">
                <? if ($_SESSION['rollsLeft'] > 0 ){?>
                    <button type="submit" class="roll-button">Re-roll</button>
                <? } else {?>
                    <h1 class >NO ROLLS LEFT</h1>
                <? } ?>
            </div>
        </form>

        <form method="POST" action="<?= url("/yatzee/score") ?>">
            <button type="submit" class="roll-button">CALCULATE</button>
        </form>

        <div class="possible-scores">
            <form method="POST" action="<?= url("/yatzee/record-score") ?>">
                <? if (isset($_SESSION['possibleScores'])) {
                    foreach ($_SESSION['possibleScores'] as $key => $value) {?>
                        
                            <input type="radio"  name="selectedScore" value="<?= $key ?>" id="<?= $key ?>" 
                            <? if (!empty($chartArray[$key]) || ($chartArray[$key] > -1)) { ?>
                                    disabled
                                <? } ?> 
                            >
                            <label for="<?= $key ?>" 
                                <? if (!empty($chartArray[$key]) || ($chartArray[$key] > -1)) { ?>
                                    style="text-decoration: line-through"
                                <? } ?> 
                            >
                            <?= $key ?>'s score <?= $value ?>
                            </label><br>
                        <? }
                    
                } ?>
                <button type="submit" class="roll-button">Record Score</button>
            </form>
        </div>
    <? } ?>

    <div class="game-score">
        <p>Score card</p>

        <table class="rounds">
            <tr>
                <th>Category</th>
                <th>Score</th>
            </tr>
            <?php
            foreach (array_keys($chartArray) as $key) :
                if ($key != "playsLeft") {?>
                    <tr>
                        <td><?= $key ?></td>
                        <td><?= $chartArray[$key] ?></td>
                    </tr>
                <?php }
            endforeach ?>
        </table>

    </div>

    <p>
        <a href='<?= url('/yatzee/game-over')?>'>
            <input type='submit' class="new-game-button" value='RESET SCORE / PLAY NEW GAME'/>
        </a>
    </p>

</div>
