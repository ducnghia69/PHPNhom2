
<?php 

include_once("model/product.php");
include_once("model/cart.php");

session_start();

if (isset($_REQUEST["addcart"])) {
	$idproduct = $_REQUEST["addcart"];
	Cart::GetListCartFromIDProduct($idproduct);
	
}
if(isset($_POST['id']) && isset($_POST['quantity'])){
    $idproduct = $_POST['id'];
	$quantity = $_POST['quantity'];
    Cart::UpdateCart($idproduct, $quantity);
}
if(isset($_POST['idremove'])){
	$idproduct = $_POST['idremove'];
	Cart::DeleteCart($idproduct);
}
$lsCart =  Cart::GetCart();
include_once("header-shopping.php");
?>



<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg">
<div class="container">
	<h2 class="title-page">Giỏ hàng</h2>
</div> <!-- container //  -->
</section>
<!-- ========================= SECTION INTRO END// ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
<div class="container-fluid">
	<div class="discount-code">
		<img src="https://cdn1.iconfinder.com/data/icons/logistics-solid/64/Logistic-30-512.png" />
		<p>Big or small… We can handle it all.</p>
	</div>
	<?php if(Cart::GetCart() == null) {?>
		<div class="product-null">
			<img src="https://iticsystem.com/img/empty-cart.png" />
			<a href="shopping" class="continue-buy-item">Shopping</a>
		</div>
	<?php }else{ ?> 
	<div class="cart-page-product-header">
        <div class="name-product">Product</div>
        <div class="cart-price">Price</div>
        <div class="cart-quantity">Quantity</div>
        <div class="cart-total-price">Total Price</div>
        <div class="cart-action">Action</div>
    </div>
	<?php foreach ($lsCart as $key => $value){?>
 
        <div class="cart-item-product">
            <div class="id-item-hide"> <?php echo $value->product->idproduct?></div>
            <div class="item-product">
                    <img src="<?php echo $value->product->image?>" alt="<?php echo $value->product->nameproduct?>" />
                <p>
				<?php echo $value->product->nameproduct?>
                </p>
            </div>
            <div class="item-price"><?php echo $value->product->price?>₫</div>
            <div class="item-quantity">
              
                <button class="cart-button-outline cart-sub">
                    -
                </button>
                <input class="cart-button-outline cart-button-outline-mid" value="<?php echo $value->quantity?>">
                <button class="cart-button-outline cart-add">
                    +
                </button>
            </div>
            <div class="item-total-price"><?php echo $value->total?>₫</div>
           
            <button class="item-action">Delete</button>
            
        </div>
    <?php } ?>
    <div class="cart-page-product-footer">
        <a href="shopping">
            << Tiếp tục mua hàng
        </a>
        <div class="cart-page-summary">
            <div class="cart-page-summary-subtotal-text">
                Tổng(<span><?php echo $value->quantity?></span> sản phẩm):
            </div>
            <div class="cart-page-summary-subtotal-amount">
				<?php echo $value->total?>
            </div>
        </div>
        <button class="ml-5 cart-buy-items">Mua ngay</button>
    </div>
	 <?php } ?>
</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<!-- ========================= SECTION  ========================= -->
<section class="section-name bg padding-y">
<div class="container">
<h6>Hoàn trả</h6>
<p>Hoàn trả tiền nếu giao sản phẩm lỗi.</p>

</div><!-- container // -->
</section>
<!-- ========================= SECTION  END// ========================= -->

<!-- ========================= FOOTER ========================= -->
<footer class="section-footer border-top padding-y">
	<div class="container">
		<p class="float-md-right"> 
			&copy Copyright 2019 All rights reserved
		</p>
		<p>
			<a href="#">Terms and conditions</a>
		</p>
	</div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->



</body>
</html>