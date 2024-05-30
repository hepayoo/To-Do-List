<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "todolist";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "DELETE FROM task";

if ($connection->query($sql) === TRUE) {
    header("Location: ./index.php/");
    exit();
} else {
    echo "Error deleting all records: " . $connection->error;
}

$connection->close();
?>
