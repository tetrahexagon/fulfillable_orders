<?php

namespace Common\Contracts;

interface IFileReader {

    /**
     * Initialize fileparser dinamycally based on the file's extension
     */
    public function initFileParser(): void;
    /**
     * Opens file for read
     * @param $file file pointer
     */
    public function openForRead($file): void;

    /**
     * Closes the opened file
     */
    public function closeFile(): void;
}