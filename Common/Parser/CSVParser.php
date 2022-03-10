<?php

namespace Common\Parser;
use Common\Contracts\IFileParser;

class CSVParser implements IFileParser{

    protected $header;
    protected $data;
     

    public function __construct(){
        $this->header   = [];
        $this->data     = [];
    }

    public function parseRow(&$handle): mixed
    {
        return fgetcsv($handle);
    }

    public function setContent(mixed $data): void
    {
        $this->data = $data;
    }
    
    public function getContent(): mixed
    {
        return $this->data;
    }

    public function setHeader(mixed $data): void
    {        
        $this->header = $data;
    }

    public function getHeader(): array
    {
        return $this->header;
    }

    public function addDataRow(mixed $data): void
    {   
        $tmp = [];

        for($i = 0; $i < count($this->header); $i++){
            $tmp[$this->header[$i]] = $data[$i];
        }

        $this->data[]=  $tmp;
    }

    
}