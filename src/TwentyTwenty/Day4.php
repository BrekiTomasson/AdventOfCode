<?php

namespace BrekiTomasson\AdventOfCode\TwentyTwenty;

use BrekiTomasson\AdventOfCode\Common\Day;
use BrekiTomasson\AdventOfCode\Common\Input;
use Illuminate\Support\Collection;

class Day4 implements Day {

    public Collection $input;

    public function __construct()
    {
        $this->input = Input::get('2020-4.txt')->separateByBlanks()->input;
    }

    public function solvePartOne()
    {
        return $this->partOneLogic($this->input);
    }

    public function solvePartTwo()
    {
        return $this->partTwoLogic($this->input);
    }

    public function partOneLogic(Collection $input) : int
    {
        $valid = $input->filter(fn($passport) => str_contains($passport, "byr"))
            ->filter(fn($passport) => str_contains($passport, "iyr"))
            ->filter(fn($passport) => str_contains($passport, "eyr"))
            ->filter(fn($passport) => str_contains($passport, "hgt"))
            ->filter(fn($passport) => str_contains($passport, "hcl"))
            ->filter(fn($passport) => str_contains($passport, "ecl"))
            ->filter(fn($passport) => str_contains($passport, "pid"));

        return $valid->count() ?: 0;
    }

    public function partTwoLogic(Collection $input) : int
    {
        $valid = $input
            // Birth year must be set and between 1920 and 2002.
            ->filter(function ($passport) {
                return str_contains($passport, "byr") && $this->isValidBirthYear($passport);
            })
            // Issue year must be set and between 2010 and 2020.
            ->filter(function ($passport) {
                return str_contains($passport, "iyr") && $this->isValidIssueYear($passport);
            })
            // Expiration year must be set and between 2020 and 2030.
            ->filter(function ($passport) {
                return str_contains($passport, "iyr") && $this->isValidExpirationYear($passport);
            })
            // Height must be set and between 150cm and 193cm or 59in and 76in
            ->filter(function ($passport) {
                return str_contains($passport, "hgt") && $this->isValidHeight($passport);
            })
            // Hair color must be set and a valid hexadecimal string
            ->filter(function ($passport) {
                return str_contains($passport, "hcl") && $this->isValidHairColor($passport);
            })
            // Eye color must be set and match one of listed values.
            ->filter(function ($passport) {
                return str_contains($passport, "ecl") && $this->isValidEyeColor($passport);
            })
            // Passport ID must be set and be a nine-digit number (including leading zeroes)
            ->filter(function ($passport) {
                return str_contains($passport, "pid") && $this->isValidPassportNumber($passport);
            });

        return $valid->count() ?: 0;
    }

    public function keyValue(string $string, string $key) : int|string|null
    {
        return preg_match("/$key:(#?.+?)\b/", $string, $array) ? $array[1] : null;
    }

    // Specific checkers for part two to keep the code clean.

    public function isValidBirthYear(string $passport) : bool
    {
        $byr = $this->keyValue($passport, "byr");

        return $byr >= 1920 && $byr <= 2002;
    }

    public function isValidIssueYear(string $passport) : bool
    {
        $iyr = $this->keyValue($passport, "iyr");

        return $iyr >= 2010 && $iyr <= 2020;
    }

    public function isValidExpirationYear(string $passport) : bool
    {
        $eyr = $this->keyValue($passport, "eyr");

        return $eyr >= 2020 && $eyr <= 2030;
    }

    public function isValidHeight(string $passport) : bool
    {
        $hgt = $this->keyValue($passport, "hgt");

        $values = [];
        if (preg_match("/(.*?)(\D+)/", $hgt, $values)) {
            if ($values[2] === "in") {
                return $values[1] >= 59 && $values[1] <= 76;
            }

            if ($values[2] === "cm") {
                return $values[1] >= 150 && $values[1] <= 193;
            }
        }

        return false;
    }

    public function isValidHairColor(string $passport) : bool
    {
        $hcl = $this->keyValue($passport, "hcl");

        return preg_match("/^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/", $hcl, $match);
    }

    public function isValidEyeColor(string $passport) : bool
    {
        $ecl = $this->keyValue($passport, "ecl");

        return str_contains($ecl, "amb") || str_contains($ecl, "blu") ||
            str_contains($ecl, "brn") || str_contains($ecl, "gry") || str_contains($ecl, "grn") ||
            str_contains($ecl, "hzl") || str_contains($ecl, "oth");

    }

    public function isValidPassportNumber($passport) : bool
    {
        $pid = (string) $this->keyValue($passport, "pid");

        return strlen($pid) === 9 && is_numeric($pid);
    }

}
