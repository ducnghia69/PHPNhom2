<?php
    include_once("model/user.php");
    include_once("model/book.php");
    $listBook = Book::getList();
    // $userName = $_REQUEST["username"];
    // $user = new User($userName, "12345", "Nghia Nghia xinh dep");
    $jsonBook = json_encode($listBook);
    echo $jsonBook;
?>