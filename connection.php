<?php 
class Database{
    public static $connection;
    //DB Connection
    public static function setUpConnection(){
       if(!isset(Database::$connection)){
             Database::$connection = new mysqli("localhost","root","kith123","Eshop","3306");
       }
    }

    //insert update delete
    public static function iud($q){
        Database::setUpConnection();
        Database::$connection->query($q);
    }

    //select
    public static function search($q){
        Database::setUpConnection();
        $resultSet = Database::$connection->query($q);
        return $resultSet;
    }
}

?>