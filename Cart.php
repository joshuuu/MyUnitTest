<?php

require_once __DIR__ . '/Product.php';

class Cart
{
    private $productAll = [];

    public function __construct()
    {
        $this->productAll = [
            Product::$TAG_RED => [],
            Product::$TAG_GREEN => [],   
        ];
    }

    public function addProduct(Product $product)
    {
        if (null == $product) {
            return false;
        }

        if (Product::$TAG_RED == $product->getTag()) {
            array_push($this->productAll[Product::$TAG_RED], $product);
        } elseif (Product::$TAG_GREEN == $product->getTag()) {
            array_push($this->productAll[Product::$TAG_GREEN], $product);
        } else {
            throw new CartException("Invalid product tag.");
        }

        return true;
    }

    private function _isProductCountMatch()
    {
        $redCount = count($this->productAll[Product::$TAG_RED]);
        $greenCount = count($this->productAll[Product::$TAG_GREEN]);

        return ($redCount == $greenCount);
    }

    public function checkout()
    {
        if (false == $this->_isProductCountMatch()) {
            throw new CartException("Product count mismatch!");
        }

        $totalCost = 0;
        foreach ($this->productAll[Product::$TAG_RED] as $product) {
             $totalCost += $product->getPrice(); 
        }
        foreach ($this->productAll[Product::$TAG_GREEN] as $product) {
             $totalCost += $product->getPrice(); 
        }

        return intval($totalCost*0.75);
    }

    public function costCheck()
    {
        if (false == $this->_isProductCountMatch()) {
            throw new CartException("Product count mismatch!");
        }

    }

}

class CartException extends Exception
{
}

?>
