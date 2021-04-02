<?php

declare(strict_types=1);

namespace Elmittil\Dice;

/**
 * Class DiceHand.
 */
class DiceHand
{
    private array $allDice;

    const FACES = 6;

    public function __construct(int $diceQty)
    {
        for ($i = 0; $i < $diceQty; $i++)
        {
            $this->allDice[$i] = new Dice(self::FACES);
        }
    }

    public function roll(int $diceQty): void 
    {
        $this->sum = 0;
        for ($i = 0; $i < $diceQty; $i++)
        {
            $this->sum += $this->allDice[$i]->roll();
        }
    }

    public function getLastHandRoll(int $diceQty): string
    {   
        $res = "";
        for ($i = 0; $i < $diceQty; $i++)
        {
            $res .= $this->allDice[$i]->getLastRoll() . ", ";
        }
        return $res . " = " . $this->sum;
    }
}
