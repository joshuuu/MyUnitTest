<?php

require_once __DIR__ . '/../Cart.php';
require_once __DIR__ . '/../Product.php';

class CartTest extends PHPUnit_Framework_TestCase
{
    private $cart;
    private $products = [];

    protected function setUp()
    {
        $this->cart = new Cart();
        $this->products = [
            new Product('Red01', 100, Product::$TAG_RED),
            new Product('Red02', 50, Product::$TAG_RED),
            new Product('Green01', 25, Product::$TAG_GREEN),
            new Product('Green02', 60, Product::$TAG_GREEN)   
        ];
    }

    protected function tearDown()
    {
        $this->cart = null;
        $this->products = [];
    }

    public function testProductConstructorAndGetter()
    {
        $product = new Product('Red01', 100, Product::$TAG_RED);
        $this->assertNotNull($product);
        $this->assertEquals('Red01', $product->getName());
        $this->assertEquals(100, $product->getPrice());
        $this->assertEquals(Product::$TAG_RED, $product->getTag());
    }

    // only buy one red tag product
    public function testMismatchProductCount_01()
    {
        $this->setExpectedException('CartException');
        $redProduct = $this->products[0];
        $this->cart->addProduct($redProduct);
        $this->cart->checkout();
    }

    // test for checkout
    public function testCheckout_01()
    {
        $redProduct = $this->products[0];
        $greenProduct = $this->products[2];
        $this->cart->addProduct($redProduct);
        $this->cart->addProduct($greenProduct);
        $this->assertEquals(93, $this->cart->checkout());
    }
}

?>
