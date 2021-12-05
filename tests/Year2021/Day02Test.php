<?php

beforeEach(function() {
    $this->day = new BrekiTomasson\AdventOfCode\Days\Day02;
});

it('tests day 2 part 1', function () {
    expect($this->day->testPartOne())->toEqual(150);
});

it('tests day 2 part 2', function () {
    expect($this->day->testPartTwo())->toEqual(900);
});
