<?php 
class Book {
    #properties
    var $id;
    var $price;
    var $title;
    var $author;
    var $year;
    #endProperties

    #Construct function
    function __construct ($id, $price, $title, $author, $year) {
        $this->id = $id;
        $this->price = $price;
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }

    #Member function
    function display() {
        echo "Price: " . $this->price . "<br>";
        echo "Title: " . $this->title . "<br>";
        echo "Author: " . $this->author . "<br>";
        echo "Year: " . $this->year . "<br>";
    }
    static function getList() {
        $listBook = array();
        array_push($listBook, new Book(1,5, "Java", "nghiaJava", 2019)); //Thêm 1 phần tử vào mảng
        array_push($listBook, new Book(2,6, "OOP", "nghiaOOP", 2018));
        array_push($listBook, new Book(3,7, "Ruby", "nghiaRuby", 2017));
        array_push($listBook, new Book(4,8, "Rails", "nghiaRails", 2016));
        array_push($listBook, new Book(5,9, "Tomcat", "nghiaTomcat", 2015));
        return $listBook;
    }
    static function getListFromFile($search = null){
        $data = file("data/book.txt");
        $arrBook = [];
        foreach($data as $key => $value){
            $row = explode("#",$value); //tách chuỗi ngăn bởi #
            if(
                strlen(strstr($row[0],$search)) || strlen(strstr($row[3],$search)) ||
                strlen(strstr($row[1],$search)) || strlen(strstr($row[4],$search)) ||
                strlen(strstr($row[2],$search)) || $search == null
            )
            $arrBook[] = new Book($row[0],$row[1],$row[2],$row[3],$row[4]);
        }
        return $arrBook;
    }
    static function addToFile($content){
        
        $myfile = fopen("data/book.txt", "a") or die("Unable to open file!");
        if(Book::checkLineFeedLastText())
            fwrite($myfile, "". $content);
        else
            fwrite($myfile, "\n". $content);
        fclose($myfile);
    }
    static function delete($id){
        $data = Book::getListFromFile();
        $data_res = [];
        foreach($data as $key => $value){
            if($value->id != $id){
                $data_res[] = $value;
            }
        }    
        $text_write = "";
        $myfile = fopen("data/book.txt", "w") or die("Unable to open file!");
        foreach($data_res as $key => $value){
            $text_write.= $value->id."#".$value->price."#".$value->title."#".$value->author."#".$value->year;            
        }
      
        fwrite($myfile, $text_write);
        fclose($myfile);
    }
    static function edit(Book $content){
        $data = Book::getListFromFile();
        $text_write = "";
        $myfile = fopen("data/book.txt", "w") or die("Unable to open file!");
        foreach($data as $key => $value){          
            if( $content->id == $value->id){
                $text_write.= $content->id."#".$content->title."#".$content->price."#".$content->author."#".$content->year."\n";
            }  
            else $text_write.= $value->id."#".$value->price."#".$value->title."#".$value->author."#".$value->year;
        }       
        fwrite($myfile, $text_write);
        fclose($myfile);
    }
    static function getSTT(){
        $max = 0;
        $data = Book::getListFromFile();
        foreach($data as $key => $value){
            $max =  max($value->id,$max);
        }  
        return $max+1;
    }
    static function checkLineFeedLastText(){
        $data="data/book.txt";
        $linecount = 0;
        $handle = fopen($data, "r");
        while(!feof($handle)){
            $line = fgets($handle);
            $linecount++;
        }      
        fclose($handle); 
        $count = sizeof(Book::getListFromFile());
        if($linecount > $count) return true;
        return false;
    }
}
