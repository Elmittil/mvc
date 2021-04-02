<?php

declare(strict_types=1);

namespace Elmittil\Dice;

/**
 * Class Dice.
 */
class Dice
{
    private ?int $roll = null;

    private int $faces;

    public function __construct(int $faces_var)
    {
        $this->faces = $faces_var;

    }
    public function roll(): int
    {
        $this->roll = rand(1, $this->faces);

        return $this->roll;
    }

    public function getLastRoll(): int
    {
        return $this->roll;
    }
}
