<?php

namespace App\Config\Exception;

use App\Exception\AbstractAppExeption;
use Throwable;

class ConfigFileNotFoundException extends AbstractAppExeption {
    
    public function __construct($dirname = "", int $code = 500, Throwable $previous = NULL) {
        $message = "Config file '$dirname' not found";
        parent::__construct($message, $code, $previous);
    }
}
