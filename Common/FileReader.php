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

    public function __construct(string $file)
    {
        $this->fileName = pathinfo($file, PATHINFO_BASENAME);
        $this->fileExt  = pathinfo($file, PATHINFO_EXTENSION);
        $this->openForRead($file);     

    } 

    public function loadContent(): void {
        try{
        
            $this->initFileParser();
            $this->readFileContent();

        }catch(\Exception $e){

            //Place for the error handling/throwing custom exception,logging, etc.. , but by definition, the program's behaviour cannot be changed
        } finally {

            $this->closeFile();
        }


        die(var_dump($this->parser->getContent()));
    }
    public function initFileParser(): void
    {
        $this->parser = new ReflectionClass("Common\Parser\\".strtoupper($this->fileExt)."Parser");
        $this->parser = $this->parser->newInstance();
    }

    public function readFileContent(){
        
        $this->resetRow();
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
    }
 
    public function resetRow(): void
    {
        $this->rows = 0;
    }

    public function openForRead($file):void
    {
        $this->handle = fopen($file,"r");
    }

    public function closeFile(): void
    {
        fclose($this->handle);
    }
}