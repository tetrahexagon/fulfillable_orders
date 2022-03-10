<?php

namespace Common;

use Common\Contracts\IFileReader;

use ReflectionClass;

class FileReader implements IFileReader {

    protected $fileName;
    protected $fileExt;
    protected $row;
    protected $handle;
    protected  $parser;

    protected $fileIsOpened = false;
    
    public function __construct(string $file)
    {
        $this->fileName = pathinfo($file, PATHINFO_BASENAME);
        $this->fileExt  = pathinfo($file, PATHINFO_EXTENSION);

        if(!$this->openForRead($file)){
            
            if(\Common\ConfigManager::getSingleOption("debug_mode") == 0){                
                exit(1);
            } 
        }

    } 

    public function resetRow(): void
    {
        $this->rows = 0;
    }

    public function setFileIsOpened(bool $value): void
    {
        $this->fileIsOpened = $value;
    }

    public function getFileIsOpened(): bool
    {
        return $this->fileIsOpened;
    }

    public function loadContent(): bool 
    {
        $result = false;
        try{
        
            $this->initFileParser();
            $result = $this->readFileContent();

        }catch(\Exception $e){

            //Place for the error handling/throwing custom exception,logging, etc.. , but by definition, the program's behaviour cannot be changed
        } finally {

            $this->closeFile();
        }

        return $result; 
    }
    public function initFileParser(): bool
    {   
        try{
            $this->parser = new ReflectionClass("Common\Parser\\".strtoupper($this->fileExt)."Parser");
            $this->parser = $this->parser->newInstance();
        }catch(\Exception $e){

            $this->closeFile();
            echo $e->getMessage()."\n";
            return false;
        }
        
        return true;
    }

    public function readFileContent(): bool
    {
        
        $this->resetRow();
        try{
            while( ($data = $this->parser->parseRow($this->handle)))
            {
                if($this->row == 0) //In the old code there was an error, the header row is in the row 0.
                { 
                    $this->parser->setHeader($data);
                }else{
                    $this->parser->addDataRow($data);
                }
    
                $this->row++;
            }
        }catch(\Exception $e){
            echo $e->getMessage()."\n";
            
            $this->parser->setHeader([]);
            $this->parser->setContent([]);

            return false;
        }
        
        return true;
    }
 
    

    public function openForRead($file): void
    {
        try{
            $this->handle = fopen($file,"r");
        }catch(\Exception $e){
            echo $e->getMessage()."\n";
            $this->setFileIsOpened(false); 
            return ;
        }
        $this->setFileIsOpened(true); 
    }

    public function closeFile(): void
    {
        if($this->fileIsOpened)
            fclose($this->handle);

        $this->setFileIsOpened(false);
    }
}