<?php

namespace Common\Contracts;

interface IFileParser {

    /**
     * parses one line from data file
     * @param $handle file pointer
     */
    public function parseRow(&$handle): mixed;

    /**
     * Returns with readed content
     */
    public function getContent(): mixed;

    /**
     * Sets file content property to the given value
     */
    public function setContent(mixed $data): void; 
    /**
     * Returns with readed header
     */
    public function getHeader(): array;
    
    /**
     * Sets file header property to the given value
     */
    public function setHeader(mixed $data): void;

}