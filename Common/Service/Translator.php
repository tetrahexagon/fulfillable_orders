<?php

namespace Common\Service;

use Common\ConfigManager;

class Translator {

    public function get(string $value): string
    {
        return ConfigManager::getSingleOption($value,'translations');
    }
}