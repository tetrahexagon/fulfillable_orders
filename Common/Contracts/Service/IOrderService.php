<?php

namespace Common\Contracts\Service;

interface IOrderService {
 
    /**
     * Setter for orders data
     * @param $rawData mixed
     * @return void
     */
    public function setOrders(mixed $rawData): void;

    /**
     * Getter for unsorted orders
     * @return mixed;
     */
    public function getOrders(): mixed;

    /**
     * Getter for sorted orders
     * @return mixed;
     */
    public function getSortedOrders(): mixed;

    /**
     * Setter for fulfillable orders
     * @param mixed $value
     */
    public function setFulFillableOrders( mixed $value ): mixed;
    
    /**
     * Adds a row to the fulfillable orders
     * @param mixed $value
     */
    public function addItemToFulFillableOrders(mixed $value ): mixed;
    
    /**
     * returns with the fulfillable orders
     * @return mixed
     */
    public function getFulFillableOrders(): mixed;

    /**
     * Reads stock info from string and builds it into manageable object
     * @param string $rawStock
     * 
     * @return void
     */
    public function buildStock(string $rawStock): void;

    /**
     * Getter for stock info/data
     * 
     * @return object
     */
    public function getStock(): object;


}