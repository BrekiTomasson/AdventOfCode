<?php

namespace BrekiTomasson\AdventOfCode\Contracts;

use Illuminate\Support\Collection;

class Input
{
    public string $rawInput;

    public Collection $input;

    public function removeBlankRows() : self
    {
        $this->input = $this->input->reject(fn($value, $key) => $value === '' || $value === null);

        return $this;
    }
}
