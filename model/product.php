<?php 
$lsproduct = array();
class Product {
    #properties
    var $idproduct;
    var $nameproduct;
    var $price;
    var $image;
    var $info;
    #endProperties

    #Construct function
    function __construct ($idproduct, $nameproduct, $price, $image, $info) {
        $this->idproduct = $idproduct;
        $this->nameproduct = $nameproduct;
        $this->price = $price;    
        $this->image = $image;    
        $this->info = $info;    
    }
    static function connect(){
        //B1: Tạo kết nối
        $conn = new mysqli("localhost","root","","shopping");
        //B2: Thao tác với CSDL: CRUD
        if($conn->connect_error)
            die("Kết nối thất bại. Chi tiết:" . $conn->connect_error);
        $conn->set_charset("utf8"); //Hướng đối tượng
        //mysqli_set_charset($conn,"utf8"); -- Hướng thủ tục   
        return $conn;
    }
    static function GetProductFromDB(){
       
        $conn = Product::connect();
        $sql = "SELECT * FROM product";
        //if($key != null)
         //   $sql .= " WHERE  Title LIKE '%$key%' or Author LIKE '%$key%' or Year = '$key'";
        $result = $conn->query($sql);
        global $lsproduct;
        if($result->num_rows > 0){
            while($row = $result -> fetch_assoc()){
               // $book = new Book($row[0],$row[1],$row[2],$row[3],$row[4]);
                $product = new Product($row["IDProduct"],$row["NameProduct"], $row["Price"], $row["Image"], $row["Info"]);              
                array_push($lsproduct, $product);
            }
        }
        //B3: Giải phóng kết nối
        $conn->close();
        return $lsproduct;
    }
    static function GetProductFromIDProduct($idproduct){
        $conn = Product::connect();
        $sql = "SELECT * FROM product WHERE IDProduct = '$idproduct'";
        //if($key != null)
         //   $sql .= " WHERE  Title LIKE '%$key%' or Author LIKE '%$key%' or Year = '$key'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result -> fetch_assoc()){
               // $book = new Book($row[0],$row[1],$row[2],$row[3],$row[4]);
                $product = new Product($row["IDProduct"],$row["NameProduct"], $row["Price"], $row["Image"], $row["Info"]);              
                 break;
            }
        }
        //B3: Giải phóng kết nối
        $conn->close();
        if($product != null) return $product;
        return null;
    }
}