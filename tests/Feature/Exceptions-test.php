<?php

use BrekiTomasson\AdventOfCode\Exceptions\FileNotFoundException;

test('FileNotFoundException throws the right exception', function() {
   throw new FileNotFoundException("Fail!");
})->throws(FileNotFoundException::class, "Input file not found: Fail!");
