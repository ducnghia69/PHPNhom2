<?php
class User{
    var $idUser;
    var $userName;
    var $passWord;
    var $fullName;
    function __construct($userName, $passWord, $fullName,$idUser)
    {
        $this->userName = $userName;
        $this->passWord = $passWord;
        $this->fullName = $fullName;
        $this->idUser = $idUser;
    }
    static function connect(){
        //B1: Tạo kết nối
        $conn = new mysqli("localhost","root","","contact");
        //B2: Thao tác với CSDL: CRUD
        if($conn->connect_error)
            die("Kết nối thất bại. Chi tiết:" . $conn->connect_error);
        $conn->set_charset("utf8"); //Hướng đối tượng
        //mysqli_set_charset($conn,"utf8"); -- Hướng thủ tục   
        return $conn;
    }
    /**
     * Xasc thực người sử dụng
     * @param $userName string Tên đăng nhập
     * @param $passWord string Mật khẩu
     * @return User hoặc null nếu không tồn tại
     */
    static function authentication($userName , $passWord){
        $conn = User::connect();
        $sql = "SELECT * FROM user WHERE UserName = '$userName' and PassWord = '$passWord' ";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result -> fetch_assoc()){
               // $book = new Book($row[0],$row[1],$row[2],$row[3],$row[4]);
               return new User($userName, $passWord, $row["FullName"], $row["IDUser"]);
            }
           
        }
        $conn->close();
        return null;

        // if($userName == "ndnghia69@gmail.com" && $passWord == "1"){
        //     return new User($userName, $passWord, "Đức Nghĩa");
        // }
        
    }

    // static function authentication($userName , $passWord){
    //     $conn = Book::connect();
    //     $sql = "SELECT * FROM book";
    //     $result = $conn->query($sql);
    //     $user = User::__construct(a,b,c);
    //     if($result->num_rows > 0){
    //         while($row = $result -> fetch_assoc()){
    //            // $book = new Book($row[0],$row[1],$row[2],$row[3],$row[4]);
    //             $book = new Book($row["ID"],$row["Price"],$row["Title"],$row["Author"],$row["Year"]);              
    //             array_push($lsBook, $book);
    //         }
    //     }


    //     if($userName == "ndnghia69@gmail.com" && $passWord == "1"){
    //         return new User($userName, $passWord, "Đức Nghĩa");
    //     }
    //     return null;
    // }
}
?>