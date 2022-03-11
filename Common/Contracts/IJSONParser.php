<?php

namespace Common\Contracts;

interface IJSONParser {

    /**
     * Parses string input as JSON
     * @param string $jsonInput
     * 
     * @return array
     */
    public function parseJson(string $jsonInput): object;

    /**
     * Setter for error prop
     * @param bool $value
     * 
     * @return void
     */
    public function setError(bool $value): void;

    /**
     * Getter for error prop
     * 
     * @return bool
     */
    public function getError(): bool;
}