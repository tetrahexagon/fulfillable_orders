<?php

namespace Common\Service;

use \Common\Contracts\Service\IOrderService;
use \Common\Parser\JSONParser;
use \Common\Service\Console;

class OrderService implements IOrderService {

    protected mixed $rawOrders  =   null;
    protected array $sortedOrders;
    protected array $fulFillableOrders;
    protected object $stock;

    protected $jsonParser;
    protected $console;
    protected $translator;

    public function __construct()
    {
        $this->jsonParser   = new JSONParser();
        $this->console      = new Console();
        $this->translator   = new Translator();
    }

    public function setOrders($rawData): void
    {
        $this->rawOrders = $rawData;
    }

    public function getOrders(): mixed
    {
        return $this->rawOrders;
    }

    public function sortOrders(): bool
    {
        $tmp = $this->rawOrders;

        $result = usort($tmp, function($a, $b) {
                $pc = -1 * ($a['priority'] <=> $b['priority']);
                return $pc == 0 ? $a['created_at'] <=> $b['created_at'] : $pc;
            }); 
        $this->sortedOrders = $tmp; 
        
        return $result;
        
    }

    public function getSortedOrders(): mixed
    {
        return $this->sortedOrders;
    }

    public function setFulFillableOrders( mixed $value ): mixed 
    {
        $this->getFulFillableOrders = $value;
    }

    public function addItemToFulFillableOrders(mixed $value ): mixed 
    {
        $this->fulFillableOrders[]=$value;
    }
    public function getFulFillableOrders(): mixed 
    {
        return $this->fulFillableOrders;
    }

    public function buildStock(string $rawStock): void 
    {
        $stock = $this->jsonParser->parseJson($rawStock);
        
        if($this->jsonParser->getError()){
            echo "Invalid json!\n";
            exit(1);
        }
        
        $this->stock = $stock;
    }

    public function getStock(): object 
    {
        return $this->stock;
    }

    public function buildFulFillableOrders(): void
    {
        foreach($this->sortedOrders as $orderItem)
        {
            if($this->stock->{$orderItem['product_id']} >= $orderItem['quantity']){
                $this->fulFillableOrders []= $orderItem;
            } 
        } 
    }

    public function printFulFillableOrders( array $header = [] ): void
    {        
        foreach($header as $element){
            $this->console->printFormatted($element);
        }
        $this->console->newLine();

        foreach($header as $element){
            $this->console->printLine("=");
        }
        $this->console->newLine();

        foreach($this->fulFillableOrders as $orderItem)
        {
            foreach($header as $headerItem){
                if($headerItem == 'priority'){
                    $orderItem['priority'] = $this->translator->get('prio_'.$orderItem['priority']); 
                } 
                $this->console->printFormatted($orderItem[$headerItem]);
            }
            $this->console->newLine();

        }
    }
}