<?php

namespace BrekiTomasson\AdventOfCode\TwentyTwenty;

use BrekiTomasson\AdventOfCode\Common\Day;
use BrekiTomasson\AdventOfCode\Common\Input;
use Illuminate\Support\Collection;

class Day1 extends Day {

    public function __construct()
    {
        $this->input = Input::get('2020-1.txt')->asCollectionByLine()->input;

        $this->testInput = Input::get('2020-1-test.txt')->asCollectionByLine()->input;
        $this->partOneTestExpectedResult = 514579;
        $this->partTwoTestExpectedResult = 241861950;
    }

    public function testPartOne() : bool
    {
        return $this->partOneLogic($this->testInput, 2020) === $this->partOneTestExpectedResult;
    }

    public function testPartTwo() : bool
    {
        return $this->partTwoLogic($this->testInput, 2020) === $this->partTwoTestExpectedResult;
    }

    public function solvePartOne() : int
    {
        if ($this->testPartOne()) {
            return $this->partOneLogic($this->input, 2020);
        }
    }

    public function solvePartTwo() : int
    {
        if ($this->testPartTwo()) {
            return $this->partTwoLogic($this->input, 2020);
        }
    }

    // ==== Logic Below ====

    // Find two numbers in $input that sum up to $target and return their product.
    public function partOneLogic(Collection $input, $target) : int
    {
        // Create all iterations of the input and itself.
        $duplicate = $input->crossJoin($input);

        // Find the first row whose values add up to $target.
        $values = $duplicate->filter(function ($row) use ($target) {
            return $row[0] + $row[1] === $target;
        })->first();

        // Return the sum of those two values.
        return $values[0] * $values[1];
    }

    // Find three numbers in $input that sum up to $target and return their product.
    // Not entirelly happy with how this was solved, to be honest, but this method
    // is both faster and less memory-intense than cross-joining the full list three
    // times, which would have been the more straight-forward solution...
    public function partTwoLogic(Collection $input, $target) : int
    {
        $duplicate = $input->crossJoin($input);

        // First we filter down to the first value pair that also has a match that sums to $target.
        $valuePair = $duplicate->filter(function ($value) use ($input, $target) {
            return $input->contains($target - $value[0] - $value[1]);
        })->first();

        // Then we reverse-engineer what the missing third value should be.
        $thirdValue = $target - $valuePair[0] - $valuePair[1];

        // After double-checking that this value truly exists, return the product.
        if ($input->contains($thirdValue)) {
            return $valuePair[0] * $valuePair[1] * $thirdValue;
        }

    }


}
