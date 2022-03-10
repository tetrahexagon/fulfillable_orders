<?php
namespace tests;

use PHPUnit\Framework\TestCase;
use \Common\Validator\ArgsValidator;

class ValidatorTest extends TestCase {
    protected $validArguments = ["argc" => 2, "argv" => ["get_fulfillable_orders.php","asd"]];
    protected $invalidArguments = ["argc" => 1, "argv" => ["get_fulfillable_orders.php","asd"]];

    public function testApplyAncientRulesValidCase(){
        
        $validator = new ArgsValidator();
        $validator->setValues($this->validArguments);
        $validator->fieldsExists();
        
        $this->assertTrue($validator->applyAncientRules());
    }

    public function testApplyAncientRulesInvalidCase(){
        
        $validator = new ArgsValidator();
        $validator->setValues($this->invalidArguments);
        $validator->fieldsExists();
        
        $this->assertTrue($validator->applyAncientRules());
    }
    
    public function testApplyRulesValidCase(){
        
        $validator = new ArgsValidator();
        $validator->setValues($this->validArguments);
        $validator->fieldsExists();
        
        $this->assertTrue($validator->applyRules());
    }

    public function testApplyRulesInvalidCase(){
        
        $validator = new ArgsValidator();
        $validator->setValues($this->invalidArguments);
        $validator->fieldsExists();
        
        $this->assertFalse($validator->applyRules());
    }

    public function testValidatorIntegerValidCase(){
        $validator = new ArgsValidator(); 
        $this->assertTrue($validator->validateInteger(2));
    }
    
    public function testValidatorIntegerFromStringValidCase(){
        $validator = new ArgsValidator(); 
        $this->assertTrue($validator->validateInteger("2"));
    }

    public function testValidatorIntegerInvalidCase(){
        $validator = new ArgsValidator(); 
        $this->assertFalse($validator->validateInteger("someText"));
    }

    public function testValidatorIntegerValueValidCase(){
        $validator = new ArgsValidator(); 
        $this->assertTrue($validator->validateIntegerValue(2,2));
    }

    public function testValidatorIntegerValueInvalidCase(){
        $validator = new ArgsValidator(); 
        $this->assertFalse($validator->validateIntegerValue(2,1));
    }
    
    public function testValidatorValidCase()
    {
        $validator = new ArgsValidator();
        $validator->validate($this->validArguments);
        $this->assertTrue($validator->valid());
    }

    public function testValidatorInvalidCase(){
        
        $validator = new ArgsValidator();
        $validator->validate($this->invalidArguments);
        $this->assertFalse($validator->valid());
    }

    
}