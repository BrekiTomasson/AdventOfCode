<?php

namespace BrekiTomasson\AdventOfCode\Common;

use BrekiTomasson\AdventOfCode\Exceptions\FileNotFoundException;
use Illuminate\Support\Collection;

class Input {

    /**
     * @var string The raw input as read from the file.
     */
    protected string $rawInput;

    /**
     * @var Collection The input, parsed to a Collection.
     */
    public Collection $input;

    /**
     * @var string The directory in which the input files are found.
     */
    private string $inputDirectory = __DIR__ . '/../Input/';

    public function __construct(string $file)
    {
        $this->rawInput = $this->loadFile($file);
    }

    /**
     * Static method offering a semantic shortcut to the constructor.
     */
    public static function get(string $file) : self
    {
        return new self($file);
    }

    /**
     * Load a file from the input directory.
     */
    protected function loadFile(string $file) : string
    {
        if (file_get_contents($this->inputDirectory . $file) === false) {
            throw new FileNotFoundException($file);
        }

        return file_get_contents($this->inputDirectory . $file);
    }

    /**
     * Parses the raw contents of the input file into a collection, line by line.
     */
    public function asCollectionByLine(bool $keepBlankRows = false) : self
    {
        $this->input = new Collection(preg_split("/\r\n|\n|\r/", $this->rawInput));

        if ($keepBlankRows === false) {
            $this->removeBlankRows();
        }

        return $this;
    }

    /**
     * Parses the raw contents of the input file as keys and values separated by an given string.
     */
    public function toKeyValBySeparator(string $separator) : self
    {
        $this->input = $this->input->map(function ($value) use ($separator) {
            $newKey = strstr($value, $separator, true);
            $newValue = str_replace($newKey . $separator, '', $value);

            return [
                'key' => $newKey,
                'value' => $newValue
            ];
        });

        return $this;
    }

    /**
     * Merge lines, separate by blank lines.
     */
    public function separateByBlanks() : self
    {
        // Replace all whitespaces with spaces.
        $this->rawInput = trim(preg_replace("/\s/", ' ', $this->rawInput));

        // Replace double spaces with linebreaks.
        $this->rawInput = trim(preg_replace("/\s\s/", "\n", $this->rawInput));

        return $this->asCollectionByLine();
    }

    /**
     * Remove all blank rows from the parsed input.
     *
     * @return $this
     */
    public function removeBlankRows() : self
    {
        $this->input = $this->input->reject(fn($value, $key) => $value === '' || $value === null);

        return $this;
    }

}
