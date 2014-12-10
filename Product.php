<?php

class Product
{
    public static $TAG_RED      = 'R';
    public static $TAG_GREEN    = 'G';
   
    private $name;
    private $price;
    private $tag;

    public function __construct($name, $price, $tag)
    {
        $this->name = $name;
        $this->price = $price;
        $this->tag = $tag;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getTag()
    {
        return $this->tag;
    }

}

?>
