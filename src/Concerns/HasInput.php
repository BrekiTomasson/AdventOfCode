<?php

namespace BrekiTomasson\AdventOfCode\Concerns;

use BrekiTomasson\AdventOfCode\Contracts\Input;
use Illuminate\Support\Collection;

trait HasInput
{
    public Input $input;

    private string $inputDirectory = __DIR__ . '/../Input/';

    protected function readRawInputFile(int $day, int $part, bool $testing = false)
    {
        $this->input = new Input;

        $path = $this->inputDirectory . "$day/$part/";

        if ($testing === true) {
            $path .= "test/";
        }

        $this->input->rawInput = $this->loadFile($path, 'input.txt');
    }

    public function getInputByLine(int $day, int $part, bool $keepBlankRows = false, bool $testing = false) : self
    {
        $this->readRawInputFile($day, $part, $testing);

        $this->input->input = new Collection(preg_split("/\r\n|\n|\r/", $this->input->rawInput));

        if ($keepBlankRows === false) {
            $this->input->removeBlankRows();
        }

        return $this;
    }

    public function ensureLinesAreIntegers() : void
    {
        $this->input->input = $this->input->input->map(fn ($value) => (int) $value);
    }

    public function splitInputLinesOnSeparator(string $separator) : void
    {
        $this->input->input = $this->input->input->map(fn ($value) => explode($separator, $value));
    }

    protected function loadFile(string $path, string $file) : string
    {
        if (file_get_contents($path . $file) === false) {
            throw new \Exception("$file not found in $path.");
        }

        return file_get_contents($path . $file);
    }

    protected function getRawInput() : string
    {
        return $this->input->rawInput;
    }



}
