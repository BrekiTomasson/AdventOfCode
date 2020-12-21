<?php

namespace BrekiTomasson\AdventOfCode\Common;

use Illuminate\Support\Collection;

abstract class Day {

    public Collection $input;
    public Collection $testInput;

    public string|int $partOneTestExpectedResult;
    public string|int $partTwoTestExpectedResult;


}
