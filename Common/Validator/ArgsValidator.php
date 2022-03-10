<?php

namespace Common\Validator;

use Common\Contracts\IValidatorImplementation;
use stdClass;

class ArgsValidator extends Validator implements IValidatorImplementation
{
    public function __construct(){ 
        parent::__construct([ 
            "argv"  =>  "array",
            "argc"  =>  "int",
        ]);
    }

    protected function setValues(array $params){
        
        $this->values = $params;
    }
    
    public function validate(array $params): void
    {
        $this->setValues($params);
        $this->fieldsExists();
        $this->applyRules(); 
    }
    

    private function fieldsExists()
    {
        $valueKeys  = array_keys($this->values);
        $ruleKeys   = array_keys($this->rules);
        $i = 0;
        if(count($valueKeys) === count($ruleKeys)){

            while($i< count($valueKeys) && in_array($valueKeys[$i],$ruleKeys)){
                $i++;
            }

            if($i === count($ruleKeys)){
                
                return true;
            }
        }
        
        $this->addGeneralError("[".get_class($this)."]Number of parameters are ambiguous");
    
    }

    public function applyRules(): bool
    {
        
        if($this->applyAncientRules()){
            if($this->validateIntegerValue($this->values["argc"],2)){
                $this->addError("argc","2 (int)","intValueError");
            }
        }
        return is_null($this->errors);
    }

    public function validateIntegerValue($param, int $value): bool
    {
        return ($value === filter_var($param, FILTER_VALIDATE_INT   ));
    }

    
}