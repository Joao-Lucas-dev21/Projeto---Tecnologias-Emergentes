<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todolist_bd";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e){
    echo "Falha" . $e->getMessage();
}
?>