<?php 
$user = unserialize($_SESSION["user"]);
class Label {
    #properties
    var $idlabel;
    var $labelname;
    var $iduser;
    #endProperties

    #Construct function
    function __construct ($idlabel, $labelname,$iduser) {
        $this->idlabel = $idlabel;
        $this->labelname = $labelname;
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
    static function GetIDLabel(){
        global $user;
        $conn = Label::connect();
        $sql = "SELECT * FROM label";
        //if($key != null)
         //   $sql .= " WHERE  Title LIKE '%$key%' or Author LIKE '%$key%' or Year = '$key'";
        $result = $conn->query($sql);       
        $countlabel = $result->num_rows + 1;
        return $countlabel;
    }
    static function AddToDB(Label $content){
        global $user;
        $idlabel = Label::GetIDLabel();
        $conn = Label::connect(); 
        $sql = "INSERT INTO label(IDLabel, LabelName, IDUser) VALUES ('$idlabel','$content->labelname','$user->idUser')";
        $result = $conn->query($sql);
        if($result != true)
           echo 'Lỗi khi tạo nhãn';
        //B3: Giải phóng kết nối
        $conn->close();
       
    }
    static function GetLabelFromDB(){
        global $user;
        $conn = Label::connect();
        $sql = "SELECT * FROM label WHERE IDUser = '$user->idUser'";
        $result = $conn->query($sql);   
        $lslabel = array();  
        if($result->num_rows > 0){
            while($row = $result -> fetch_assoc()){
               // $book = new Book($row[0],$row[1],$row[2],$row[3],$row[4]);
                $label = new Label($row["IDLabel"],$row["LabelName"],$user->idUser);              
                array_push($lslabel, $label);
            }
        }
        //B3: Giải phóng kết nối
        $conn->close();
        return $lslabel;
    }
 }
?>