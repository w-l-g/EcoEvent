<?php

namespace App\Exception;

use Throwable;

class EmailAlreadyExistException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        if ($message === ""){
            $message = "Email déjà renseigné dans la base";
        }
        parent::__construct($message, $code, $previous);
    }
}