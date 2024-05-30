<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "todolist";
$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$name = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: ./index.php/");
        exit;
    }

    $id = $_GET["id"];
    $sql = "SELECT * FROM task WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: ./index.php/");
        exit;
    }
    $name = $row["name"];

} else {
    $id = $_POST["id"];
    $name = $_POST["name"];

    do {
        if (empty($id) || empty($name)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE task SET name='$name' WHERE id=$id";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Task updated correctly";
        header("location: ./index.php/");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h2>Edit Task</h2>

    <?php

    if (!empty($errorMessage)) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$errorMessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }

    ?>

    <form method="post">
        <input type="hidden" name="id"  value="<?php echo $id;?>">
        <div class="mb-3">
            <label class="form-label">Task Name:</label>
            <input type="text" class="form-control" name="name" value="<?php echo $name;?>" required>
        </div>

        <?php
        if (!empty($successMessage)) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        ?>

        <button type="submit" class="btn btn-success">Save Changes</button>
        <a class="btn btn-secondary" href="./index.php/" role="button">Cancel</a>
    </form>
</div>

</body>
</html>
