<?php

namespace Service;

use \Common\Contracts\Service\IOrderService;

class OrderService implements IOrderService {

    protected mixed $rawOrders;

    protected mixed $sortedOrders;

    protected array $fulFillableOrders;

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
        $this->sortedOrders = $this->rawOrders;
        try{
            usort($this->sortedOrders, function($a, $b) {
                $pc = -1 * ($a['priority'] <=> $b['priority']);
                return $pc == 0 ? $a['created_at'] <=> $b['created_at'] : $pc;
            });
        }catch(\Exception $e){
            echo $e->getMessage()."\n";
            return false;
        }

        return true;
        
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
}