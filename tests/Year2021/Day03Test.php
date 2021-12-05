<?php

beforeEach(function() {
    $this->day = new BrekiTomasson\AdventOfCode\Days\Day03;
});

it('tests day 3 part 1', function () {
    expect($this->day->testPartOne())->toEqual(198);
});

it('tests day 3 part 2', function () {
    expect($this->day->testPartTwo())->toEqual(230);
});
