<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Elmittil\Yatzee\ScoreChart;
use Elmittil\Yatzee\YatzeeLogic;

use function Mos\Functions\{
    destroySession,
    renderView,
    redirectTo,
    url
};

/**
 * Controller for Yatzy game.
 */
class Yatzee
{
    use ControllerTrait;

    private YatzeeLogic $logic;
    private ScoreChart $scoreChart;


    public function intro(): ResponseInterface
    {
        $this->initialise();
        $_SESSION['rollsLeft'] = 2;
        $this->uploadChart();

        $data = [
            "header" => "Yatzee",
        ];

        $body = renderView("layout/yatzee.php", $data);


        return $this->response($body);
    }


    public function play(): ResponseInterface
    {
        $this->initialise();

        if (!array_key_exists('rolledValues', $_SESSION)) {
            $this->logic->rollHand();
            $rolledDiceValues = $this->logic->getRolledDiceValues();
            $_SESSION['rolledValues'] = $rolledDiceValues;
        }

        $data = [
            "header" => "Yatzee",
        ];

        $body = renderView("layout/playyatzee.php", $data);

        return $this->response($body);
    }

    public function reroll(): ResponseInterface
    {
        $this->initialise();

        if ($_SESSION['rollsLeft'] > 0) {
            $this->rerollSelectedDice();
            $_SESSION['rollsLeft'] = $_SESSION['rollsLeft'] - 1;
        }
        return $this->redirect(url("/yatzee/play"));
    }

    public function score(): ResponseInterface
    {
        $this->initialise();

        $combos =  $this->logic->scorableCombos($_SESSION['rolledValues']);
        $possibleScores = $this->logic->comboTotal($combos);
        $_SESSION['possibleScores'] = $possibleScores;
        return $this->redirect(url("/yatzee/play"));
    }

    public function recordScore(): ResponseInterface
    {
        $this->initialise();

        if (isset($_POST['selectedScore'])) {
            $key = $_POST['selectedScore'];
            $this->logic->setScore($key, $_SESSION['possibleScores'][$key]);
        }
        unset($_SESSION['possibleScores']);
        unset($_SESSION['rolledValues']);
        $_SESSION['rollsLeft'] = 2;

        return $this->redirect(url("/yatzee/play"));
    }

    public function gameOver(): ResponseInterface
    {
        $this->scoreChart = new ScoreChart();
        $this->uploadChart();

        // destroySession();
        // $this->initialise();
        // $this->uploadChart();

        $_SESSION['rollsLeft'] = 2;
        return $this->redirect(url("/yatzee/play"));
    }

    private function initialise()
    {
        if (array_key_exists('chart', $_SESSION)) {
            $this->scoreChart = $_SESSION['chart'];
        } else {
            $this->scoreChart = new ScoreChart();
        }

        $this->logic = new YatzeeLogic($this->scoreChart);
    }


    private function rerollSelectedDice()
    {
        $originalRolls = $_SESSION['rolledValues'];
        if (!isset($_POST['selectedDice'])) {
            return;
        }
        $selectedDice = $_POST['selectedDice'];

        $newDiceQty = count($selectedDice);
        $newDiceValues = $this->logic->reRoll($newDiceQty);
        $i = 0;

        foreach ($selectedDice as $selected) {
            $originalRolls[$selected - 1] = $newDiceValues[$i];
            $i++;
        }
        $_SESSION['rolledValues'] = $originalRolls;
    }


    private function uploadChart()
    {
        $_SESSION['chart'] = $this->scoreChart;
    }
}