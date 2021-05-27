<?php

use BrekiTomasson\AdventOfCode\TwentyTwenty\Day1;
use BrekiTomasson\AdventOfCode\TwentyTwenty\Day2;
use BrekiTomasson\AdventOfCode\TwentyTwenty\Day3;
use BrekiTomasson\AdventOfCode\TwentyTwenty\Day4;

// DAY ONE - PART ONE
// Find two numbers that add up to 2020 and multiply them.

it('solves test for Day 1, Part 1', function () {
    $day = new Day1;
    $data = getCollectionByLine('2020-1-test.txt');

    expect($day->partOneLogic($data, 2020))->toEqual(514579);
})->group('day1');

// DAY ONE - PART TWO
// Find three numbers that add up to 2020 and multiply them.

it('solves test for Day 1, Part 2', function () {
    $day = new Day1;
    $data = getCollectionByLine('2020-1-test.txt');

    expect($day->partTwoLogic($data, 2020))->toEqual(241861950);
})->group('day1');

// DAY TWO - PART ONE
// Check how many passwords match the safety criteria.

it('solves test for Day 2, Part 1', function () {
    $day = new Day2;
    $data = getCollectionByLine('2020-2-test.txt');

    expect($day->partOneLogic($data))->toEqual(2);
})->group('day2');

// DAY TWO - PART TWO
// Check how many passwords match the updated safety criteria.

it('solves test for Day 2, Part 2', function () {
    $day = new Day2;
    $data = getCollectionByLine('2020-2-test.txt');

    expect($day->partTwoLogic($data))->toEqual(1);
})->group('day2');

// DAY THREE - PART ONE
// Travel down the hill (right threee, down one) and count the trees we hit.

it('solves test for Day 3, Part 1', function () {
    $day = new Day3;
    $data = getCollectionByLine('2020-3-test.txt');

    expect($day->partOneLogic($data, 3, 1))->toEqual(7);
})->group('day3');

// DAY THREE - PART TWO
// Multiply many different routes down the hill with each other.

it('solves test for Day 3, Part 2', function () {
    $day = new Day3;
    $data = getCollectionByLine('2020-3-test.txt');

    expect($day->partTwoLogic($data))->toEqual(336);
})->group('day3');

// DAY FOUR - PART ONE
// Validate existence of keys in passports.

it('solves test for Day 4, Part 1', function () {
    $day  = new Day4;
    $data = getMergedLines('2020-4-test.txt');

    expect($day->partOneLogic($data))->toEqual(2);
})->group('day4');

// DAY FOUR - PART TWO
// Validate existence of keys in passports.
// (Test not based on original sample input)

it('solves test for Day 4, Part 2', function () {
    $day  = new Day4;
    $data = getMergedLines('2020-4-test.txt');

    expect($day->partTwoLogic($data))->toEqual(2);
})->group('day4');
