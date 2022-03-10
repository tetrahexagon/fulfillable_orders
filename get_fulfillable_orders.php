<?php


require __DIR__ . '/vendor/autoload.php';

use \Common\ConfigManager;
use \Common\Validator\ArgsValidator;
use Common\FileReader;

class FulFillableOrders 
{

    public $configManager;

    public function __construct(int $argc,array $argv)
    {
        $this->configManager = new ConfigManager(); 
        $argsValidator = new ArgsValidator(); 
        $argsValidator->validate(compact("argc","argv"));
        
        if(!$argsValidator->valid()){

            $argsValidator->printErrors();
            exit(1);
        }
        $this->fileReader = new FileReader($this->configManager->getEnv("orders_csv"));
        $this->fileReader->loadContent();
    } 



}

$fulFillableOrders = New FulFillableOrders($argc,$argv);


