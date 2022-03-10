<?php

namespace Common\Contracts;

use Throwable;

interface IValidatorImplementation {

    public function applyRules(): bool;
}