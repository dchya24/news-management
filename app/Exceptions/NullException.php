<?php

namespace App\Exceptions;

use Exception;

class NullException extends Exception
{
    public function render(){
        response()->json([
            'statusCode' => $this->getCode(),
            'message' => $this->getMessage()
        ], $this->getCode()); 
    }
}
