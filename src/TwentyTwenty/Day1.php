<?php

namespace BrekiTomasson\AdventOfCode\TwentyTwenty;

use BrekiTomasson\AdventOfCode\Common\Day;
use BrekiTomasson\AdventOfCode\Common\Input;
use Illuminate\Support\Collection;

class Day1 implements Day {

    public Collection $input;

    public function __construct()
    {
        $this->input = Input::get('2020-1.txt')->asCollectionByLine()->input;
    }

    public function solvePartOne() : int
    {
        return $this->partOneLogic($this->input, 2020);
    }

    /** @throws \Exception */
    public function solvePartTwo() : int
    {
        return $this->partTwoLogic($this->input, 2020);
    }

    /**
     * Find two numbers in $input that sum up to $target and return their product.
     */
    public function partOneLogic(Collection $input, int $target) : int
    {
        // Create all iterations of the input and itself.
        $duplicate = $input->crossJoin($input);

        // Find the first row whose values add up to $target.
        $values = $duplicate->filter(fn($row) => $row[0] + $row[1] === $target)->first();

        // Return the sum of those two values.
        return $values[0] * $values[1];
    }

    /**
     * Find three numbers in $input that sum up to $target and return their product. Not entirelly happy with how
     * this was solved, to be honest, but this method is both faster and less memory-intense than cross-joining the
     * full list three times, which would have been the more straight-forward solution...
     *
     * @throws \Exception
     */
    public function partTwoLogic(Collection $input, int $target) : int
    {
        $duplicate = $input->crossJoin($input);

        // First we filter down to the first value pair that also has a match that sums to $target.
        $valuePair = $duplicate->filter(fn($value) => $input->contains($target - $value[0] - $value[1]))->first();

        // Then we reverse-engineer what the missing third value should be.
        $thirdValue = $target - $valuePair[0] - $valuePair[1];

        // After double-checking that this value truly exists, return the product.
        if ($input->contains($thirdValue)) {
            return $valuePair[0] * $valuePair[1] * $thirdValue;
        }

        // If all else fails, return 0.
        // TODO - Create test for this.
        return 0;
    }
}
