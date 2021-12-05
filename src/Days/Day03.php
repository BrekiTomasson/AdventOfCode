<?php

namespace BrekiTomasson\AdventOfCode\Days;

use BrekiTomasson\AdventOfCode\Concerns\DoesProcessing;

class Day03 extends DoesProcessing
{
    public array $bits;
    public string $gamma;
    public string $epsilon;

    public function __construct()
    {
        $this->day = 3;
    }

    public function getInput(int $part, bool $testing)
    {
        $this->getInputByLine($this->day, $part, false,$testing);
    }

    protected function calculateBits() : void
    {
        $this->bits = [];

        $this->input->input->each(function ($row) {
            foreach (str_split($row) as $index => $character) {
                $this->bits[$index] = ($this->bits[$index] ?? '') . $character;
            }
        });
    }

    protected function clearGreekCharacters() : void
    {
        $this->gamma = '';
        $this->epsilon = '';
    }

    protected function leastCommonCharacter(string $string) : string
    {
        $totals = array_count_values(str_split($string));
        asort($totals);

        return array_keys($totals)[0];
    }

    protected function mostCommonCharacter(string $string) : string
    {
        $totals = array_count_values(str_split($string));
        arsort($totals);

        return array_keys($totals)[0];
    }

    public function partTwoUsesPartOneInput() : bool
    {
        return true;
    }

    public function partOneLogic() : int
    {
        $this->clearGreekCharacters();
        $this->calculateBits();

        foreach($this->bits as $index => $row) {
            $this->gamma .= $this->mostCommonCharacter($row);
            $this->epsilon .= $this->leastCommonCharacter($row);
        }

        return bindec($this->gamma) * bindec($this->epsilon);
    }

    public function partTwoLogic()
    {
        $this->clearGreekCharacters();
        $this->calculateBits();

        // @todo
    }
}
