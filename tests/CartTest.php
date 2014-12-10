<?php

require_once __DIR__ . '/../Cart.php';
require_once __DIR__ . '/../Product.php';
require_once __DIR__ . '/../Productmanager.php';

class CartTest extends PHPUnit_Framework_TestCase
{
    private $cart;
    private $products;

    protected function setUp()
    {
        $this->cart = new Cart();
        $this->products = ProductManager::getInstance()->getProductList();
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
