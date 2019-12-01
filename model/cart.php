<?php 
include_once("model/product.php");
class Cart {
    #properties   

    var $product;
    var $quantity;
    var $total;
    #endProperties
    
    #Construct function
    function __construct ($product, $quantity) {
        $this->product = $product;
        $this->quantity = $quantity;   
        $this->total = $quantity*$product->price;
    }
 
    static function GetCart(){
        $carts = array();
        if(isset($_SESSION["lsCart"]))
            $carts = unserialize($_SESSION['lsCart']);
        return $carts;
    }

    static function GetListCartFromIDProduct($idproduct){
        $lstCart = Cart::GetCart();
        $existCart = false;
        foreach($lstCart as $key => $value){
            if($value->product->idproduct == $idproduct)
            {
                $value->quantity = $value->quantity + 1;
                
                $value->total = $value->product->price * $value->quantity;
                $existCart = true;
            }
        }
       
        if(!$existCart)
        {
            $product = Product::GetProductFromIDProduct($idproduct);
            $cart = new Cart($product, 1);
            array_push($lstCart, $cart);
        }
        $_SESSION["lsCart"] = serialize($lstCart);
    }
    static function UpdateCart($idproduct , $quantity){
        $lstCart = Cart::GetCart();
        foreach($lstCart as $key => $value){
            if($value->product->idproduct == $idproduct)
            {
                $value->quantity = $quantity;
                
                $value->total = $value->product->price * $value->quantity;
            }
        }
        $_SESSION["lsCart"] = serialize($lstCart);
    }
    static function DeleteCart($idproduct){
        $lstCart = Cart::GetCart();
        
        foreach($lstCart as $key => $value){
            if($value->product->idproduct == $idproduct)
            {
                break;
            }
        }
        unset($lstCart[$key]);
        $_SESSION["lsCart"] = serialize($lstCart);
    }
}


?>