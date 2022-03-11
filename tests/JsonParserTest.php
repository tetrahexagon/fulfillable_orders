<?php
namespace tests;

use Common\Parser\JSONParser;
use PHPUnit\Framework\TestCase; 

class JsonParserTest extends TestCase 
{

    protected $parser;
        
    public function __construct()
    {
        parent::__construct();
        $this->parser = new JSONParser();
    }

    public function testGetErrorMethod(){
       
        $this->assertIsBool($this->parser->getError(),"Common\Parser\JSONParser::getError()");
    }

    public function testParseJsonStringValidCase(){
        
        $result = $this->parser->parseJson('{"1":8,"2":4,"3":5}');
         
        $this->assertFalse($this->parser->getError(),"An error happened during the json parsing");
        $this->assertIsObject($result,"Result of JSON parsing");
        $this->assertGreaterThan(0,count( (array) $result));
    }

    public function testParseJsonStringInvalidCase(){
        
        $result = $this->parser->parseJson('{á"1":8,"2":4,"3":5}');
        
        $this->assertTrue($this->parser->getError(),"An error happened during the json parsing");
        $this->assertIsObject($result,"Result of JSON parsing");
        $this->assertEquals(0,count( (array) $result));
    }
}
    