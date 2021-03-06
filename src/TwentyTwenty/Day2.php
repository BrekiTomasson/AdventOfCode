<?php

namespace BrekiTomasson\AdventOfCode\TwentyTwenty;

use BrekiTomasson\AdventOfCode\Common\Day;
use BrekiTomasson\AdventOfCode\Common\Input;
use Illuminate\Support\Collection;

class Day2 implements Day {

    public Collection $input;

    public function __construct()
    {
        $this->input = Input::get('2020-2.txt')->asCollectionByLine()->input;
    }

    public function solvePartOne() : int
    {
        return $this->partOneLogic($this->input);
    }

    public function solvePartTwo() : int
    {
        return $this->partTwoLogic($this->input);
    }

    // Parse a collection and return an integer with the amount of valid values.
    public function partOneLogic(Collection $input) : int
    {
        // Split each row into three parts, going from "1-3 a: abcde" to "1-3", "a", "abcde".
        // Then further split that into 'min', 'max', 'char' and 'pass' portions.
        $mapped = $input->map(fn($value) => explode(' ', str_replace(':', '', $value)))
                        ->map(fn($value) => [
                            'min'  => min(explode('-', $value[0])),
                            'max'  => max(explode('-', $value[0])),
                            'char' => $value[1],
                            'pass' => $value[2],
                        ]);

        // Is the count of letters larger than or equal to min and smaller than or equal to max?
        $filtered = $mapped->filter(function ($value) {
            return $value['min'] <= substr_count($value['pass'], $value['char']) &&
                substr_count($value['pass'], $value['char']) <= $value['max'];
        });

        return $filtered->count();
    }

    // Parse a collection and return an integer with the amount of valid values.
    public function partTwoLogic(Collection $input) : int
    {
        // Split the rows into fields: pos1, pos2, char, pass.
        $mapped = $input->map(fn($value) => explode(' ', str_replace(':', '', $value)))
                        ->map(fn($value) => [
                            // Subtracting one to get 0-based value.
                            'pos1' => explode('-', $value[0])[0] - 1,
                            'pos2' => explode('-', $value[0])[1] - 1,
                            'char' => $value[1],
                            'pass' => $value[2],
                        ]);

        // XOR check to ensure only one of the positions is true.
        $filtered = $mapped->filter(function ($value) {
            return $value['pass'][$value['pos1']] === $value['char'] xor
                $value['pass'][$value['pos2']] === $value['char'];
        });

        return $filtered->count();
    }

}
