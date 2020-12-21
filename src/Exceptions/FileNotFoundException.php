<?php

namespace BrekiTomasson\AdventOfCode\Exceptions;

use JetBrains\PhpStorm\Pure;
use Throwable;

class FileNotFoundException extends \RuntimeException {

    #[Pure] public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct("Input file not found: ${message}", $code, $previous);
    }

}
