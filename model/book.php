<?php
class Book
{
    #Begin properties
    var $id;
    var $price;
    var $title;
    var $author;
    var $year;
    #end properties

    #Construct function
    function __construct($id,$price, $title, $author, $year)
    {
        $this->id = $id;
        $this->price = $price;
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }

    #Member function
    function display()
    {
        echo "ID: " . $this->id . "<br>";
        echo "Price: " . $this->price . "<br>";
        echo "Title: " . $this->title . "<br>";
        echo "Author: " . $this->author . "<br>";
        echo "Year: " . $this->year . "<br>";
    }
    static function getList(){
        $listBook = array();
        array_push($listBook, new Book(1,5, "OOP in PHP", "nghiaPHP", 2019));
        array_push($listBook, new Book(2,3, "OOP in JAVA", "nghiaJAVA", 2017));
        array_push($listBook, new Book(3,10, "OOP in Python", "nghiaPython", 2020));
        array_push($listBook, new Book(4,15, "OOP in Ruby on Rails", "nghiaRuby", 2016));
        return $listBook;
    }
    /**
     * Lấy dữ liệu từ file
     */
    static function getListFromFile(){
        $arrayData = file("data/book.txt");
        $listBook = array();
        foreach($arrayData as $key => $value){
            $arrayItem = explode("#",$value);
            $book = new Book($arrayItem[0],$arrayItem[1],$arrayItem[2],$arrayItem[3],$arrayItem[4]);
            array_push($listBook, $book);
        }
        return $listBook;
    }
    static function Search($contentSearch){
        $arrayData = file("data/book.txt");
        $listBook = array();
        foreach($arrayData as $key => $value){
            $arrayItem = explode("#",$value);
            if(strstr( strtoupper($arrayItem[2]), strtoupper($contentSearch)) || strstr( strtoupper($arrayItem[3]), strtoupper($contentSearch)) || $contentSearch == substr($arrayItem[4],0, strlen($arrayItem[4])-2)){
                $book = new Book($arrayItem[0],$arrayItem[1],$arrayItem[2],$arrayItem[3],$arrayItem[4]);           
                array_push($listBook, $book);
            }          
        }
        return $listBook;
    }
    static function AddToFile($content){
        $myfile = fopen("data/book.txt", "a") or die("Unable to open file!");
        fwrite($myfile, "\n". $content);
        fclose($myfile);
    }
}
