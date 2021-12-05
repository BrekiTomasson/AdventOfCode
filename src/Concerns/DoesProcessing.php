<?php

namespace BrekiTomasson\AdventOfCode\Concerns;

abstract class DoesProcessing
{
    use HasInput;

    abstract public function getInput(int $part, bool $testing);

    abstract public function partTwoUsesPartOneInput() : bool;

    abstract public function partOneLogic();

    abstract public function partTwoLogic();

    public function testPartOne()
    {
        $this->getInput(1, true);

        return $this->partOneLogic();
    }

    public function testPartTwo()
    {
        $this->getInput($this->partTwoUsesPartOneInput() ? 1 : 2, true);

        return $this->partTwoLogic();
    }

    public function solvePartOne()
    {
        $this->getInput(1, false);

        return $this->partOneLogic();
    }

    public function solvePartTwo()
    {
        $this->getInput($this->partTwoUsesPartOneInput() ? 1 : 2, false);

        return $this->partTwoLogic();
    }

}
