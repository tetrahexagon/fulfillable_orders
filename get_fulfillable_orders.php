<?php
namespace App;

require __DIR__ . '/vendor/autoload.php';

use \Common\ConfigManager;

class FulFillableOrders {

    public $configManager;

    public function __construct()
    {
        $this->configManager = new ConfigManager(); 
    }



}

$fulFillableOrders = New FulFillableOrders();


