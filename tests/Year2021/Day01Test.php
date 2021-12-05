<?php

beforeEach(function() {
    $this->day = new BrekiTomasson\AdventOfCode\Days\Day01;
});

it('tests day 1 part 1', function () {
    expect($this->day->testPartOne())->toEqual(7);
});

it('tests day 1 part 2', function () {
    expect($this->day->testPartTwo())->toEqual(5);
});
