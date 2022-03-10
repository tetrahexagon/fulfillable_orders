<?php

namespace Common\Contracts;

interface IValidator 
{

    /**
     * @$param: mixed
     * returns true, if $param is integer, false if not.
     */
    public function validateInteger($param): bool;

    /**
     * @$param: mixed
     * returns true, if $param is an array, false if not.
     */
    public function validateArray($param): bool;

    /**
     * Checks, if was there an error during the validaton
     */
    public function valid(): bool;

    /**
     * returns with errors
     */
    public function errorBag(): array;

    /**
     * Runs validations, returns with validated datas
     */
    public function validate(array $params): void;


}