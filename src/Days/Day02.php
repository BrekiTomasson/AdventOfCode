<?php

namespace BrekiTomasson\AdventOfCode\Days;

use BrekiTomasson\AdventOfCode\Concerns\DoesProcessing;

class Day02 extends DoesProcessing
{
    public array $position;
    public int $aim;

    public function __construct()
    {
        $this->day = 2;
    }

    public function getInput(int $part, bool $testing)
    {
        $this->getInputByLine($this->day, $part, false,$testing);

        $this->splitInputLinesOnSeparator(' ');
    }

    public function partTwoUsesPartOneInput() : bool
    {
        return true;
    }

    protected function resetPosition() : void
    {
        $this->aim = 0;
        $this->position['x'] = 0;
        $this->position['y'] = 0;
    }

    public function partOneLogic() : int
    {
        $this->resetPosition();

        $this->input->input->each(function ($row) {
            if ($row[0] === 'forward') {
                $this->position['x'] += $row[1];
            }
            if ($row[0] === 'down') {
                $this->position['y'] += $row[1];
            }
            if ($row[0] === 'up') {
                $this->position['y'] -= $row[1];
            }
        });

        return $this->position['x'] * $this->position['y'];
    }

    public function partTwoLogic() : int
    {
        $this->resetPosition();

        $this->input->input->each(function ($row) {
            if ($row[0] === 'forward') {
                $this->position['x'] += $row[1];
                $this->position['y'] += ($this->aim * $row[1]);
            }
            if ($row[0] === 'down') {
                $this->aim += $row[1];
            }
            if ($row[0] === 'up') {
                $this->aim -= $row[1];
            }
        });

        return $this->position['x'] * $this->position['y'];
    }
}
