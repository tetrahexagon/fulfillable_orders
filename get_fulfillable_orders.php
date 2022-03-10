<?php
namespace App;

require __DIR__ . '/vendor/autoload.php';

use \Common\ConfigManager;
use \Common\Validator\ArgsValidator;
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
    } 



}

$fulFillableOrders = New FulFillableOrders($argc,$argv);


