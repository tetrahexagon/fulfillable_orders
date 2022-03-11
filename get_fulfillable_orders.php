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
    public $fileReader;

    public function __construct(int $argc,array $argv)
    {
        $this->configManager    = new ConfigManager(); 
        $this->orderService     = new OrderService();
        $this->fileReader = new FileReader($this->configManager->getEnv("orders_csv"));
        $argsValidator = new ArgsValidator(); 
        $argsValidator->validate(compact("argc","argv"));
        
        if(!$argsValidator->valid()){

            $argsValidator->printErrors();
            exit(1);
        }        
        
        $this->fileReader->loadContent();        
        
        $this->orderService->setOrders($this->fileReader->getReadedContent());
        $this->orderService->buildStock($argv[1]);
        $this->orderService->sortOrders(); 

        $this->orderService->buildFulFillableOrders();        
        $this->orderService->printFulFillableOrders($this->fileReader->getReadedHeader()); 
    } 



}

$fulFillableOrders = New FulFillableOrders($argc,$argv);


