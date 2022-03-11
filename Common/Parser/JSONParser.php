<?php

namespace Common\Parser;

use Common\Contracts\IJSONParser;
use stdClass;

class JSONParser implements IJSONParser 
{

    protected $error = false;
    
    public function parseJson(string $jsonInput): object
    {
        $result = json_decode($jsonInput);
        
        if(is_null($result)){
            
            $this->setError(true);
        }
        return $result ?? new stdClass();
    }

    public function setError( bool $value): void
    {
        $this->error = $value;
    }

    public function getError(): bool
    {
        return $this->error;
    }
}