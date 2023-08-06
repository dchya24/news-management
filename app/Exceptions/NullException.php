<?php

namespace App\Exceptions;

use Exception;

class NullException extends Exception
{
    public function render(){
        return response()->json([
            'message' => $this->getMessage()
        ], $this->getCode()); 
    }
}
