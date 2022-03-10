<?php

namespace Common\Validator;
use Common\Contracts\IValidator;
use Exception;

abstract class Validator implements IValidator
{

    protected $errors = null; 

    protected $rules;

    protected array $values;

    public function __construct(array $rules){
        $this->rules =  [ 
            "argv"  =>  "array",
            "argc"  =>  "int",
        ];
    }

    public function validateInteger($param): bool
    {
        return filter_var($param, FILTER_VALIDATE_INT);
    }

    public function validateArray($param): bool
    {
        return is_array($param);
    }

    public function valid(): bool
    {
        return is_null($this->errors);
    }

    public function errorBag(): array
    {
        return $this->errors ?? [];
    }

    public function applyAncientRules () {

        foreach($this->rules as $paramName => $rule){ 
            switch ($rule) {
                case "int": {
                    if(!$this->validateInteger($this->values[$paramName])){
                        $this->addError($paramName,$rule, "typeError");
                    }
                }
                    break;
                case "array": {
                    if(!$this->validateArray($this->values[$paramName])){
                        $this->addError($paramName,$rule,"typeError");
                    }
                }
                    break;
            }
            
            return is_null($this->errors);
        }
    }

    protected function addGeneralError($message){
        
        $this->errors["general"][] = $message;
    }

    protected function addError(string $paramName, string $expectedType, string $errorType = ""){
        
        switch($errorType){
            case "typeError": {
                $this->errors["typedErrors"][$paramName] = "The '".$paramName."' parameter has invalid type. The expected type is: '".$expectedType."'";
            }
                break;
            case "intValueError": {
                $this->errors["typedErrors"][$paramName] = "'".$paramName."' parameter must be exactly ".$expectedType;
            }
                break;
            default : {
                $this->errors["typedErrors"][$paramName] = "Unhandled error with the following parameter: '".$paramName."', expected type: '".$expectedType."'";
            }
        } 
    }

    public function printErrors(){
        $this->printGeneralErrors();
        $this->printTypedErrors();
    }

    public function printGeneralErrors(){

        if(isset($this->errors["general"]) && count($this->errors["general"])){
            foreach($this->errors["general"] as $error){
                echo $error."\n";
            }
        }
    }

    public function printTypedErrors(){

        if(isset($this->errors["typedErrors"]) && count($this->errors["typedErrors"])){
            foreach($this->errors["typedErrors"] as $error){
                echo $error."\n";
            }
        }
    }
}
