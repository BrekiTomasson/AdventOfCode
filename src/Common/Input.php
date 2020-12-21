<?php

namespace BrekiTomasson\AdventOfCode\Common;

use BrekiTomasson\AdventOfCode\Exceptions\FileNotFoundException;
use Exception;
use Illuminate\Support\Collection;

class Input {

    /** @var string The raw input as read from the file. */
    protected string $rawInput;

    /** @var Collection The input, parsed to a Collection. */
    public Collection $input;

    /** @var string The directory that the input files are found. */
    private string $inputDirectory = __DIR__ . '/../Input/';

    /**
     * Input constructor.
     *
     * @param  string  $file
     */
    public function __construct(string $file)
    {
        $this->rawInput = $this->loadFile($file);
    }

    /**
     * Static method acting as a shortcut to the constructor.
     *
     * @param  string  $file
     *
     * @return static
     */
    public static function get(string $file) : self
    {
        return new self($file);
    }

    /**
     * Load a file from the input directory.
     *
     * @param  string  $file
     *
     * @return string
     */
    protected function loadFile(string $file) : string
    {
        if (file_get_contents($this->inputDirectory . $file) === false) {
            throw new FileNotFoundException($file);
        }

        return file_get_contents($this->inputDirectory . $file);
    }

    // Methods that generate the Input collection.

    public function asCollectionByLine($keepBlankRows = false) : self
    {
        $this->input = new Collection(preg_split("/\r\n|\n|\r/", $this->rawInput));

        if ($keepBlankRows === false) {
            $this->removeBlankRows();
        }

        return $this;
    }

    // Methods that parse or process the Input collection.

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


    public function removeBlankRows() : self
    {
        $this->input = $this->input->reject(function ($value, $key) {
            return $value === '' || $value === null;
        });

        return $this;
    }

}
