<?php 

include_once("model/user.php");
include_once("model/contact.php");
$lscontact = array();
$gloContact = 0;
$user = unserialize($_SESSION["user"]);
class Contact {
    #properties
    var $idcontact;
    var $name;
    var $email;
    var $phone;
    var $ismajor;
    var $iduser;
    
    #endProperties

    #Construct function
    function __construct ($idcontact, $name, $email, $phone, $ismajor, $iduser) {
        $this->idcontact = $idcontact;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->ismajor = $ismajor;
        $this->iduser = $iduser;        
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
    static function GetIDContact(){
        global $user;
        $conn = Contact::connect();
        $sql = "SELECT * FROM contact";
        //if($key != null)
         //   $sql .= " WHERE  Title LIKE '%$key%' or Author LIKE '%$key%' or Year = '$key'";
        $result = $conn->query($sql);       
        $countcontact = $result->num_rows + 1;
        return $countcontact;
    }
    static function GetListFromDB($key = null){
        global $user;
        $conn = Contact::connect();
        $sql = "SELECT * FROM contact Where IDUser = '$user->idUser'";
        if($key != null)
            $sql = "SELECT * FROM contact WHERE  Name LIKE '%$key%' or Email LIKE '%$key%' or Phone LIKE '%$key%'";
        $result = $conn->query($sql);
        global $lscontact;
        global $gloContact;
        $gloContact = $result->num_rows;
        if($result->num_rows > 0){
            while($row = $result -> fetch_assoc()){
               // $book = new Book($row[0],$row[1],$row[2],$row[3],$row[4]);
                $contact = new Contact($row["IDContact"],$row["Name"],$row["Email"],$row["Phone"],$row["isMajor"], $row["IDUser"]);              
                array_push($lscontact, $contact);
            }
        }
        //B3: Giải phóng kết nối
        $conn->close();
        return $lscontact;
    }
    static function GetListMajorContactFromDB(){
        global $lscontact;
        $lsmajorcontact = array();
        foreach($lscontact as $key => $value){
            if($value->ismajor == 1){
                array_push($lsmajorcontact, $value);
            }
        }  
        return $lsmajorcontact;
    }
    static function addToDB(Contact $content, $data){
        
        global $user;
        $conn = Contact::connect(); 
        $countcontact = Contact::GetIDContact();
        
        $sql = "INSERT INTO contact(IDContact, Name, Email, Phone, isMajor, IDUser) VALUES ('$countcontact','$content->name','$content->email','$content->phone','$content->ismajor','$user->idUser')";
        $result = $conn->query($sql);
        if($result != true)
           echo 'Không nhập số điện thoại bị trùng';
        else{
            
            foreach($data as $key => $value){
               
                $sql2 = "INSERT INTO contact_label(IDContact, IDLabel) VALUES ( '$countcontact', '$value->idlabel')";
                $result2 = $conn->query($sql2);
                
            }  
        }
        //B3: Giải phóng kết nối
        $conn->close();
       
    }
    static function editDB(Contact $content, $data_delete, $data_add){
        $conn = Contact::connect(); 
        //var_dump($content->ismajor);
        //sửa contact
        $sql = "UPDATE contact SET Name = '$content->name' , Email = '$content->email' , Phone = '$content->phone' , isMajor = '$content->ismajor'  WHERE IDContact = '$content->idcontact'";
        $result = $conn->query($sql);       
        //xóa label
        foreach($data_delete as $key => $value){
            $sql1 = "DELETE FROM contact_label WHERE IDContact = $content->idcontact and IDLabel = $value";
            $result1 = $conn->query($sql1);
        }  
        
        //update label
        foreach($data_add as $key => $value){
               
            $sql3 = "INSERT INTO contact_label(IDContact, IDLabel) VALUES ( '$content->idcontact', '$value')";
            $result3 = $conn->query($sql3);
            
        }  
        //B3: Giải phóng kết nối
        $conn->close(); 
    }
    static function checkIsMajor($id){
        $conn = Contact::connect(); 
        //var_dump($content->ismajor);
        $sql = "select IsMajor from contact where IDContact = '$id'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result -> fetch_assoc()){
               // $book = new Book($row[0],$row[1],$row[2],$row[3],$row[4]);
              
                return $row["IsMajor"];
            }
        }
        $conn->close();
        return 0;
    }
    static function deleteDB($id){
        $conn = Contact::connect(); 
        $sql = "DELETE FROM contact_label WHERE IDContact = $id";
        $result = $conn->query($sql);
        $sql1 = "DELETE FROM contact WHERE IDContact = $id";
        $result1 = $conn->query($sql1);
        //B3: Giải phóng kết nối
        $conn->close(); 
    }
 }
?>