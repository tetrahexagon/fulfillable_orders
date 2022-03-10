<?php
namespace tests;

use Common\ConfigManager;
use PHPUnit\Framework\TestCase;
use Common\FileReader;

class FileReaderTest extends TestCase {
    
    public $configManager;

    protected $fileReader;

    public function __construct()
    {
        parent::__construct();

        $this->configManager = new ConfigManager();
    }

    public function testOpenAnExistingCsvFile(){

        $this->fileReader = new FileReader($this->configManager->getEnv("orders_csv"));        
        $this->assertTrue($this->fileReader->getFileIsOpened());        
        $this->fileReader->closeFile();
    }

    public function testOpenAnNonExistingCsvFile(){

        $this->fileReader = new FileReader("../".$this->configManager->getEnv("orders_csv"));        
        $this->assertFalse($this->fileReader->getFileIsOpened());         
        $this->fileReader->closeFile();
    }

    public function testOpenAFileWithUnhandledExtension(){

        $this->fileReader = new FileReader($this->configManager->getEnv("orders_xml")); 
                
        $this->assertTrue($this->fileReader->getFileIsOpened());         
        $this->fileReader->closeFile();
    }

    public function testInitParserWithAnExistingCsvFile(){
        $this->fileReader = new FileReader($this->configManager->getEnv("orders_csv"));        
        
        $this->assertTrue($this->fileReader->initFileParser());        
        $this->fileReader->closeFile();
    }

    public function testInitParserWithAnNonExistingCsvFile(){
        $this->fileReader = new FileReader("../".$this->configManager->getEnv("orders_csv"));    

        $this->assertTrue($this->fileReader->initFileParser());        
        $this->fileReader->closeFile();
    }

    public function testInitParserWithAFileWithUnhandledExtension(){
        $this->fileReader = new FileReader($this->configManager->getEnv("orders_xml"));        
        
        $this->assertFalse($this->fileReader->initFileParser());        
        $this->fileReader->closeFile();
    }

    public function testReadValidCsvFileContent(){
        $this->fileReader = new FileReader($this->configManager->getEnv("orders_csv"));        
        
        $this->assertTrue($this->fileReader->loadContent());        
        $this->fileReader->closeFile();
    }
}