<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

// uses(Tests\TestCase::class)->in('Feature');

use BrekiTomasson\AdventOfCode\Common\Input;
use Illuminate\Support\Collection;

expect()->extend('toBeOne', fn() => $this->toBe(1));

function getCollectionByLine(string $fileName) : Collection
{
    return Input::get($fileName)->asCollectionByLine()->input;
}

function getMergedLines(string $fileName) : Collection
{
    return Input::get($fileName)->separateByBlanks()->input;
}

