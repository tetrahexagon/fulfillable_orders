<?php

namespace Common\Contracts;

interface IFileReader {

    /**
     * Initialize fileparser dinamycally based on the file's extension
     */
    public function initFileParser(): bool;
    /**
     * Opens file for read
     * @param $file file pointer
     */
    public function openForRead($file): void;

    /**
     * Closes the opened file
     */
    public function closeFile(): void;

    /**
     * Setter for opened file status
     * @param bool $value
     */
    public function setFileIsOpened(bool $value): void;

    /**
     * getter for opened file status
     */
    public function getFileIsOpened(): bool;

    /**
     * loads file content into parser
     */
    public function loadContent(): bool;
}