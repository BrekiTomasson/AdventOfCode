<?php

namespace BrekiTomasson\AdventOfCode\TwentyTwenty;

use BrekiTomasson\AdventOfCode\Common\Day;
use BrekiTomasson\AdventOfCode\Common\Input;
use Illuminate\Support\Collection;

class Day3 implements Day {

    public Collection $input;

    public function __construct()
    {
        $this->input = Input::get('2020-3.txt')->asCollectionByLine()->input;
    }

    public function solvePartOne() : int
    {
        return $this->partOneLogic($this->input, 3, 1);
    }

    public function solvePartTwo() : int
    {
        return $this->partTwoLogic($this->input);
    }

    /**
     * @throws \Exception
     */
    public function partOneLogic(Collection $input, int $right, int $down) : int
    {
        // Define our starting point.
        $current_row = 1;
        $current_column = 1;
        $trees_hit = 0;

        while ($current_row <= $input->count()) {
            if ($this->getCharacterAt($input, $current_row, $current_column) === "#") {
                ++$trees_hit;
            }

            $current_column += $right;
            $current_row += $down;
        }

        return $trees_hit;
    }

    /**
     * @throws \Exception
     */
    public function partTwoLogic(Collection $input) : int
    {
        return $this->partOneLogic($input, 1, 1)
            * $this->partOneLogic($input, 3, 1)
            * $this->partOneLogic($input, 5, 1)
            * $this->partOneLogic($input, 7, 1)
            * $this->partOneLogic($input, 1, 2);

    }

    /**
     * Get the character at a given row and column, wrapping around if the column requested is
     * too high. Starts counting at row = 1, column = 1, so is not zero-based despite the
     * underlying data structure being zero-based.
     *
     * @throws \Exception
     */
    protected function getCharacterAt(Collection $input, int $row, int $column) : string
    {
        // Wrap around columns if requested column is higher than the max column count.
        while ($column > strlen($input[$row - 1])) {
            $column -= strlen($input[$row - 1]);
        }

        // Throw a fit if we requested a row that doesn't exist.
        if ($row <= 0 || $row > $input->count()) {
            throw new \Exception("Requested row too high!");
        }

        return $input[$row - 1][$column - 1];
    }
}
