<?php

use Illuminate\Support\Collection;

include 'vendor/autoload.php';

$days = new Collection([
    "Day 1" => new \BrekiTomasson\AdventOfCode\TwentyTwenty\Day1,
    "Day 2" => new \BrekiTomasson\AdventOfCode\TwentyTwenty\Day2,
    "Day 3" => new \BrekiTomasson\AdventOfCode\TwentyTwenty\Day3,
    "Day 4" => new \BrekiTomasson\AdventOfCode\TwentyTwenty\Day4,
]);


$days->each(function ($day, $name) {
    echo $name . ' - Part One: ' . $day->solvePartOne() . PHP_EOL;
    echo $name . ' - Part Two: ' . $day->solvePartTwo() . PHP_EOL;
});
