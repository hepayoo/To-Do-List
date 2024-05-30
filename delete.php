<?php

if(isset($_GET["id"]) ){


    $id = $_GET["id"];


    
$servername = "localhost";
$username = "root";
$password = "";
$database = "todolist";

$connection = new mysqli($servername, $username, $password, $database);


$sql = "DELETE FROM task WHERE id=$id";
$connection->query($sql);

}
header("location:./index.php");
exit;


?>