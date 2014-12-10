<?php

require_once __DIR__ . '/Product.php';

class ProductManager
{
    private static $instance = null;
    private static $PRODUCT_LIST = [];

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }
       
        return self::$instance;
    }

    protected function __construct()
    {
        ProductManager::$PRODUCT_LIST = [
            new Product('Red01', 100, Product::$TAG_RED),
            new Product('Red02', 50, Product::$TAG_RED),
            new Product('Green01', 25, Product::$TAG_GREEN),
            new Product('Green02', 60, Product::$TAG_GREEN)   
        ];
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    } 

    public function getProductList()
    {
        return ProductManager::$PRODUCT_LIST;
    }

}

?>
