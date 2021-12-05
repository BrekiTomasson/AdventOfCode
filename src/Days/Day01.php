<?php

namespace BrekiTomasson\AdventOfCode\Days;

use BrekiTomasson\AdventOfCode\Concerns\DoesProcessing;

class Day01 extends DoesProcessing
{
    public function __construct()
    {
        $this->day = 1;
    }

    public function getInput(int $part, bool $testing) : void
    {
        $this->getInputByLine($this->day, $part, false,$testing);

        $this->ensureLinesAreIntegers();
    }

    public function partTwoUsesPartOneInput() : bool
    {
        return true;
    }

    public function partOneLogic() : int
    {
        $counter = $this->input->input->reduce(static function ($carry, $item) {
            $carry[1] += ($carry[0] < $item) ? 1 : 0;
            $carry[0] = $item;
            return $carry;
        }, [PHP_INT_MAX, 0]);

        return $counter[1];
    }

    public function partTwoLogic() : int
    {
        $sample_count = count($this->input->input) - 1;
        $sliding_window = 0;

        for ($i = 0; $i < $sample_count; $i++) {
            if ($i < $sample_count - 2 && $this->input->input[$i] < $this->input->input[$i + 3]) {
                $sliding_window++;
            }
        }

        return $sliding_window;
    }
}
