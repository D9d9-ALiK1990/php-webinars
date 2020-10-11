<?php

namespace App\Config\Exception;

use App\Exception\AbstractAppExeption;
use Throwable;

class ConfigDirectoryNotFoundException extends AbstractAppExeption{
    
    public function __construct($dirname = "", int $code = 500, Throwable $previous = NULL) {
        $message = "Directory '$dirname' not found exception";
        parent::__construct($message, $code, $previous);
    }
}
