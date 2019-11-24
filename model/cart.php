<?php 

class Cart {
    #properties   
    var $quantity;
    var $total;
    #endProperties
    var $lscart = array();
    #Construct function
    function __construct ($quantity, $total) {
        $this->quantity = $quantity;   
        $this->total = $total;
    }
    static function addToCart($idproduct){
        
        $product = Product::GetProductFromIDProduct($idproduct);
        foreach($this->lscart as $key => $value){
            if($value->quantity)
        }
    }
}