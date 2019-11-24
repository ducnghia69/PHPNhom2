<?php 
$user = unserialize($_SESSION["user"]);
class Contact_Label {
    #properties
    var $idcontact;
    var $idlabel;
    #endProperties

    #Construct function
    function __construct ($idcontact, $idlabel) {
        $this->idlabel = $idlabel;
        $this->idcontact = $idcontact;   
    }
    }
?>