<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use Elmittil\Dice\Dice;
use Elmittil\Dice\DiceHand;
use Elmittil\Dice\GraphicDice;

$header = $header ?? null;
$message = $message ?? null;

$sides = 6;
$die = new Dice($sides);
$die->roll();

$diceQty = 4;
$diceHand = new DiceHand($diceQty, "regular");
$diceHand->roll($diceQty);

$graphicDie = /** @scrutinizer ignore-call */ new GraphicDice($sides);
$graphicDie->roll();
?>

<h1><?= $header ?></h1>

<p>Dice roll shows</p>
<p><?= $die->getLastRoll() ?></p>


<p>Dice hand rolls</p>
<p><?= $diceHand->getLastHandRoll($diceQty); ?></p>

<p>Graphical die rolls</p>
<img src="../htdocs/img/<?= $graphicDie->graphic() ?>.png" alt="die">

<?php var_dump($diceHand);
