$(document).ready(function () {
    itemNull();
    //change text to VNĐ
    $(".item-price").each(function () {
        var price = $(this).text().substring(0, $(this).text().length - 1);
      
        price = Math.round(price * 1000) / 1000;
        $(this).text(convertVND(parseFloat(price)) + "₫");
    });
    var amount = 0;
    var totalquantity = 0;
    $(".item-total-price").each(function () {
        var price = $(this).text().substring(0, $(this).text().length - 1);
        
        price = Math.round(price * 1000) / 1000;
        amount+= price;
        $(this).text( convertVND(parseFloat(price)) + "₫");
    });
    $(".cart-button-outline-mid").each(function () {
        console.log($(this).val());
        totalquantity+= parseInt($(this).val());
    });
    $(".cart-page-summary-subtotal-amount").text(convertVND(amount)  + "₫");
    $(".cart-page-summary-subtotal-text span").text( totalquantity );
    
    //Add number input
    $(".cart-add").click(function () {
        
        //get ID
        var id = parseInt($(this).parent().parent().find(".id-item-hide").text());
        //get quantity
        var vl = parseInt($(this).prev().val());
        //Kiểm tra nếu input là rỗng or isNaN
        if (vl.toString() == "" || vl.toString() == "NaN") vl = 1;
        //Cộng giá trị lên 1 và lấy dữ liệu ra
        $(this).prev().val(vl + 1);
        var vl2 = $(this).prev().val();
        console.log("id:" + id + " " + vl2);
        //call ajax
        $.ajax({
            type: "POST",
            url: "shopping-cart.php",
            data: {
                id: id,
                quantity: vl2
            }
        });

        var getprice = $(this).parent().prev().text();
        getprice = getprice.substring(0, getprice.length - 1);
        getprice = getprice.split(".").join("");
        
        //Lấy giá trị float và nhân lên 1000 để ra tiền VNĐ
        var valuetotal = parseFloat(getprice) * parseFloat(vl2);
        //Bỏ những số lẻ đằng sau
        valuetotal = Math.round(valuetotal * 1000) / 1000;
        
        //tính tổng
        var sum = 0;
        var sumvl = 0;
        //Tính tổng tiền và tổng số lượng những item trừ cái đã click
        $(".cart-item-product").not($(this).parent().parent()).each(function () {
            // console.log($(this).find(".item-total-price").text().substring(1));
            
            sum += parseFloat($(this).find(".item-total-price").text().substring(0, $(this).find(".item-total-price").text().length - 1).split(".").join(""));
                
            sumvl += parseInt($(this).find(".cart-button-outline-mid").val());
           
        });
        //Cộng thêm vào giá trị đã click
        
        $(".cart-page-summary-subtotal-text span").text(sumvl + parseInt(vl2));
        

        var sumtotal = (sum + valuetotal);
        sumtotal = Math.round(sumtotal * 1000) / 1000;
        sumtotal = convertVND(sumtotal);
        
        $(".cart-page-summary-subtotal-amount").text( sumtotal.toString() + "₫");
        //

        valuetotal = convertVND(valuetotal);
        $(this).parent().next().text( valuetotal.toString() + "₫");
        //tính tổng

        //Add gio hang
        addQuantityCart();
    })
    //Sub input, tương tự add input
    $(".cart-sub").click(function () {
        
        //get ID
        var id = parseInt($(this).parent().parent().find(".id-item-hide").text());
        //get quantity
        var vl = $(this).next().val();
        if (vl < 2) {
            var temp = $(this).parent().next().next();
            deleteItem(temp);
            itemNull();
        }
        else {
            $(this).next().val(vl - 1);
            var vl2 = $(this).next().val(); // get value tạm thời
            $.ajax({
                type: "POST",
                url: "shopping-cart.php",
                data: {
                    id: id,
                    quantity: vl2
                }
            });
            var getprice = $(this).parent().prev().text();
            getprice = getprice.substring(0, getprice.length - 1);
            getprice = getprice.split(".").join("");
           
            //Lấy giá trị float và nhân lên 1000 để ra tiền VNĐ
            var valueTotal = parseFloat(getprice) * parseFloat(vl2);
            valueTotal = Math.round(valueTotal * 1000) / 1000;
            //tính tổng
            var sum = 0;
            var sumvl = 0;
            $(".cart-item-product").not($(this).parent().parent()).each(function () {
                // console.log($(this).find(".item-total-price").text().substring(1));
                sum += parseFloat($(this).find(".item-total-price").text().substring(0, $(this).find(".item-total-price").text().length - 1).split(".").join(""));
              
                sumvl += parseInt($(this).find(".cart-button-outline-mid").val());
            });
            var sumTotal = (sum + valueTotal );
            sumTotal = Math.round(sumTotal * 1000) / 1000;
            sumTotal = convertVND(sumTotal);
            $(".cart-page-summary-subtotal-text span").text(sumvl + parseInt(vl2));
            $(".cart-page-summary-subtotal-amount").text( sumTotal.toString() + "₫");
            //
            valueTotal = convertVND(valueTotal);
            $(this).parent().next().text(valueTotal.toString() + "₫");


        }
        addQuantityCart();
    })
    //change input, tương tự add input
    $(".cart-button-outline-mid").change(function () {
       
        //get ID item
        var id = parseInt($(this).parent().parent().find(".id-item-hide").text());
        var vl = $(this).val();

        $.ajax({
            type: "POST",
            url: "shopping-cart.php",
            data: {
                id: id,
                quantity: vl
            }
        });

        var getprice = $(this).parent().prev().text();
        getprice = getprice.substring(0, getprice.length - 1);
        getprice = getprice.split(".").join("");
        

        var vl_temp = parseFloat(getprice);
        var valueTotal;
        if (vl != "")
            valueTotal = vl_temp * parseFloat(vl) ;
        else valueTotal = vl_temp * 1;
        valueTotal = Math.round(valueTotal * 1000) / 1000;
        //tính tổng
        var sum = 0;
        var sumvl = 0;
        $(".cart-item-product").not($(this).parent().parent()).each(function () {
            // console.log($(this).find(".item-total-price").text().substring(1));
            sum += parseFloat($(this).find(".item-total-price").text().substring(0, $(this).find(".item-total-price").text().length - 1).split(".").join(""));
              
            sumvl += parseInt($(this).find(".cart-button-outline-mid").val());
        });

        var sumTotal = (sum + valueTotal );
        sumTotal = Math.round(sumTotal * 1000) / 1000;
        sumTotal = convertVND(sumTotal);
        $(".cart-page-summary-subtotal-text span").text(sumvl + parseInt(vl));
        $(".cart-page-summary-subtotal-amount").text(sumTotal.toString() + "₫");
        //
        valueTotal = convertVND(valueTotal);
        $(this).parent().next().text(valueTotal.toString() + "₫");
        addQuantityCart();
    });
    
    $(".item-action").click(function () {
        deleteItem(this);
        itemNull();
    });
    //addQuantityCart();



    //kiem tra dang nhap
    $(".cart-buy-items").click(function () {
        var temp = localStorage.getItem("CustomerID");

        if (temp == null ) {
            $("#myModal").modal('show');
           
        } else {
            window.location.href = "/checkout/shipping";
        }
    });
    
    
});
//Xét khi giỏ hàng trống -> chuyển giao diện
function itemNull() {
    var check_null_quantity = parseInt($(".cart-page-summary-subtotal-text span").text());
    var null_total = $(".cart-page-summary-subtotal-amount").text();
    var check_null_total = parseInt(null_total.substring(0, null_total.length - 1));
    console.log(check_null_quantity + " " + check_null_total);
    if (check_null_quantity == 0 && check_null_total == 0) {
        $(".cart-page-product-header").remove();
        $(".cart-page-product-footer").remove();
        createTag("div", "product-null", "", "", ".section-content .container-fluid", 1);
        createTag("img", "", "", "", ".product-null", 1);
        createTag("a", "continue-buy-item", "", "Shopping", ".product-null", 1);
    }
}
function deleteItem(name) {
    if (confirm("Bạn có muốn xóa không!")) {
        var sum = 0;
        //delete total 
        var getprice = $(".cart-page-summary-subtotal-amount").text();
        getprice = getprice.substring(0, getprice.length - 1);
        getprice = getprice.split(".").join("");
        sum = parseFloat(getprice);
        
        sum -= parseFloat($(name).prev().text().substring(0, ($(name).prev().text().length - 1)).split(".").join(""));
        sum = Math.round(sum * 1000) / 1000;
        $(".cart-page-summary-subtotal-amount").text(  convertVND(sum) + "₫");      
        $(name).parent().remove();
        //delete total quantity
        var sum_quantity = 0;
        sum_quantity = parseInt($(".cart-page-summary-subtotal-text span").text());
        
        sum_quantity -= parseInt($(name).prev().prev().find(".cart-button-outline-mid").val());

        $(".cart-page-summary-subtotal-text span").text(sum_quantity);
        //xoa gio hang
        $(".cart").find("span").text(sum_quantity);
        
        //delete session
        var id = parseInt($(name).parent().find(".id-item-hide").text());
        console.log("ID: " + id);
        $.ajax({
            type: "POST",
            url: "shopping-cart.php",
            data: {
                idremove: id
            }
        });
    } 
}
function addQuantityCart() {
    var quantity = $(".cart-page-summary-subtotal-text").find("span").text();
    $(".cart").find("span").text(quantity);
}
function convertVND(vl) {
    vl = vl.toString();
    vl = reverseString(vl);
    vl = conver(vl);
    vl = reverseString(vl);
    return vl;
}
function reverseString(s) {
    var o = '';
    for (var i = s.length - 1; i >= 0; i--)
        o += s[i];
    return o;
}
function conver(s) {
    var o = '';
    var count = 0;
    for (var i in s) {
        if (count % 3 == 0 && count != 0) {
            o += ".";
        }
        o += s[i];
        count++;
    }
    return o;
}
function createTag(tag, classTagName, idTagName, content, tagLocation, isAppend) {
    var sTag = document.createElement(tag);
    sTag.textContent = content;
    if (classTagName != "") sTag.classList.add(classTagName);
    if (idTagName != "") sTag.id = idTagName;
    if (tag == "a") $(sTag).attr("href", "shopping");
    if (tag == "img") $(sTag).attr("src", "https://iticsystem.com/img/empty-cart.png");
    if (isAppend == 1) $(tagLocation).append(sTag);
    else $(tagLocation).html(sTag);
    return sTag;
}