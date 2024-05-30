<?php
if(isset($_GET["id"]) ){
    $id = $_GET["id"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "todolist";

    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $sql = "DELETE FROM task WHERE id=$id";

    if ($connection->query($sql) === TRUE) {
        header("Location: ./index.php/");
        exit();
    } else {
        echo "Error deleting record: " . $connection->error;
    }
    $connection->close();
} else {
    echo "No task ID specified.";
}
?>
