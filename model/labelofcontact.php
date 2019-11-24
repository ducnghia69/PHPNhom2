<?php 
class LabelOfContact {
    #properties
    var $idlabel;
    var $labelname;
    var $countcontact;
    #endProperties

    #Construct function
    function __construct ($idlabel, $labelname,$countcontact) {
        $this->idlabel = $idlabel;
        $this->labelname = $labelname;
        $this->countcontact = $countcontact;        
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
    static function GetLabelFromDatabase(){
        $user = unserialize($_SESSION["user"]);
        $conn = LabelOfContact::connect();
        $sql = "SELECT label.IDLabel, LabelName, COUNT(label.LabelName) as SoLuong FROM contact join contact_label on contact.IDContact = contact_label.IDLabel join label on label.IDLabel = contact_label.IDLabel where contact.IDUser = '$user->idUser' GROUP by label.LabelName, label.IDLabel ";
        //if($key != null)
         //   $sql .= " WHERE  Title LIKE '%$key%' or Author LIKE '%$key%' or Year = '$key'";
        $result = $conn->query($sql);
        $lslabelofcontact = array();
        if($result->num_rows > 0){
            while($row = $result -> fetch_assoc()){
               // $book = new Book($row[0],$row[1],$row[2],$row[3],$row[4]);
                $labelofcontact = new LabelOfContact($row["IDLabel"],$row["LabelName"],$row["SoLuong"]);              
                array_push($lslabelofcontact, $labelofcontact);
            }
        }
        //B3: Giải phóng kết nối
        $conn->close();
        return $lslabelofcontact;
    }
    static function GetListLabelOfContact($id){
        $user = unserialize($_SESSION["user"]);
        $conn = LabelOfContact::connect();
        $sql = "SELECT label.IDLabel, LabelName FROM contact_label join label on contact_label.IDLabel = label.IDLabel WHERE IDContact = '$id' ";
        //if($key != null)
         //   $sql .= " WHERE  Title LIKE '%$key%' or Author LIKE '%$key%' or Year = '$key'";
        $result = $conn->query($sql);
        $lslabelofcontact = array();
        if($result->num_rows > 0){
            while($row = $result -> fetch_assoc()){
               // $book = new Book($row[0],$row[1],$row[2],$row[3],$row[4]);
               $label = new Label($row["IDLabel"],$row["LabelName"],$user->idUser);
                array_push($lslabelofcontact, $label);
            }
        }
        //B3: Giải phóng kết nối
        $conn->close();
        return $lslabelofcontact;
    }
    //Kiểm tra xem label của contact có tồn tại hay không
    static function checkLabelOfContactFromIDLabel($idcontact, $idlabel){
      
        $user = unserialize($_SESSION["user"]);
        $conn = LabelOfContact::connect();
        $sql = "SELECT label.IDLabel, LabelName FROM contact_label join label on contact_label.IDLabel = label.IDLabel WHERE contact_label.IDLabel = '$idlabel' && IDContact = '$idcontact' ";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result -> fetch_assoc()){
               // $book = new Book($row[0],$row[1],$row[2],$row[3],$row[4]);
               $label = new Label($row["IDLabel"],$row["LabelName"],$user->idUser);
                return $label;
            }
        }
        //B3: Giải phóng kết nối
        $conn->close();
        return null;
    }
 }
?>