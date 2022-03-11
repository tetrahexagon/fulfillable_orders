<?php


require __DIR__ . '/vendor/autoload.php';

use \Common\ConfigManager;
use \Common\Validator\ArgsValidator;
use Common\FileReader;
use Common\Service\OrderService;

class FulFillableOrders 
{

    public $configManager;
    public $orderService;

    public function __construct(int $argc,array $argv)
    {
        $this->configManager    = new ConfigManager(); 
        $this->orderService     = new OrderService();
        $argsValidator = new ArgsValidator(); 
        $argsValidator->validate(compact("argc","argv"));
        
        if(!$argsValidator->valid()){

            $argsValidator->printErrors();
            exit(1);
        }
        $this->fileReader = new FileReader($this->configManager->getEnv("orders_csv"));
        $this->fileReader->loadContent();
        
        $this->orderService->buildStock($argv[1]); 
    } 



}

$fulFillableOrders = New FulFillableOrders($argc,$argv);


