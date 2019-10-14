<?php
class User{
    var $userName;
    var $passWord;
    var $fullName;
    function __construct($userName, $passWord, $fullName)
    {
        $this->userName = $userName;
        $this->passWord = $passWord;
        $this->fullName = $fullName;
    }
    /**
     * Xasc thực người sử dụng
     * @param $userName string Tên đăng nhập
     * @param $passWord string Mật khẩu
     * @return User hoặc null nếu không tồn tại
     */
    static function authentication($userName , $passWord){
        if($userName == "ndnghia69@gmail.com" && $passWord == "1"){
            return new User($userName, $passWord, "Đức Nghĩa");
        }
        return null;
    }
}
?>