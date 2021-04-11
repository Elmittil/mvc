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

    private int $sum = 0;

    public function __construct(int $diceQty, string $type)
    {
        if ($type == "regular") {
            for ($i = 0; $i < $diceQty; $i++) {
                $this->allDice[$i] = new Dice(self::FACES);
            }
        }

        if ($type == "graphic") {
            for ($i = 0; $i < $diceQty; $i++) {
                $this->allDice[$i] = new GraphicDice();
            }
        }
    }

    public function roll(int $diceQty): void
    {
        $this->sum = 0;
        for ($i = 0; $i < $diceQty; $i++) {
            $this->sum += $this->allDice[$i]->roll();
        }
    }

    public function getLastHandRoll(int $diceQty): string
    {
        $res = "";
        for ($i = 0; $i < $diceQty; $i++) {
            $res .= $this->allDice[$i]->getLastRoll() . ", ";
        }
        return $res . " = " . $this->sum;
    }

    public function getLastHandRollArray(int $diceQty): array
    {
        $res = array();
        for ($i = 0; $i < $diceQty; $i++) {
            $res[$i] = $this->allDice[$i]->getLastRoll();
        }
        return $res;
    }

    public function getRollSum(): int
    {
        return $this->sum;
    }
}
