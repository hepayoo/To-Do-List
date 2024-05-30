<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../style.css">
<title>Todo List</title>


</head>
<body>

<div class="container">
  <div class="title">Todo List</div>
  <form method="post" action="">
    <div class="input-field">
      <input type="text" name="task" placeholder="Add a new task" required>
      <button type="submit" name="addTask">+</button>
    </div>
  </form>
  <div class="buttons">
    <button>Complete</button>
    <button>Incomplete</button>
    <button>Delete All</button>
  </div>
  <div class="task-list">
    <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "todolist";

      $connection = new mysqli($servername, $username, $password, $database);

      if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
      }

      if (isset($_POST['addTask'])) {
          $task = htmlspecialchars($_POST['task']);
          $sql = "INSERT INTO task (name) VALUES ('$task')";
          if ($connection->query($sql) === TRUE) {
              header("Location: " . $_SERVER['PHP_SELF']);
              exit();
          } else {
              echo "Error: " . $sql . "<br>" . $connection->error;
          }
      }

      $sql = "SELECT * FROM task";
      $result = $connection->query($sql);

      if (!$result) {
          die("Invalid query: " . $connection->error);
      }

      while ($row = $result->fetch_assoc()) {
          echo "
          <div class='task-item'>
          <i class='fa-regular fa-circle'></i>
              <span>" . htmlspecialchars($row['name']) . "</span>
              <i class='fa fa-times' href='./delete.php$row[id]'></i>
          </div>
         
          ";
      }

      $connection->close();
    ?>
  </div>
</div>
<script src="https://kit.fontawesome.com/523d8fe978.js" crossorigin="anonymous"></script>
</body>
</html>
