<?php 
try{
    $host = 'localhost';
    $db_name = 'mydb';
    $charset = 'utf8';
    $username = 'root';
    $password = '';

    $db = new PDO("mysql:host=$host;dbname=$db_name;charset=$charset",$username,$password);
    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //echo "Database connection is succesful";
}catch(PDOException $e){
    echo "Connection error $e";
}
?>