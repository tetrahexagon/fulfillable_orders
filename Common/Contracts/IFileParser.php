<?php

namespace Common\Contracts;

interface IFileParser {

    public function parseRow(&$handle): mixed;

    public function getContent(): mixed;
}