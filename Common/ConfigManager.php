<?php

namespace Common;

class ConfigManager {
    private $config;

    public function __construct()
    {    
        $this->loadConfig();
    }

    private function loadConfig(){
        $this->config = parse_ini_file(__DIR__ . '/../config/env.ini');
    }

    public function getEnv( string $key ): string{
        
        return $this->config[$key] ?? "N/A";
    }
}