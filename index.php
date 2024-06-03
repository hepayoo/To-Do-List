<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../style.css">
<title>Todo List</title>
<style>
  .task-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
    padding: 10px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 5px;
    cursor: pointer;
  }

  .task-item input[type="checkbox"] {
    margin-right: 10px;
  }

  .task-item .task-content {
    display: flex;
    align-items: center;
    flex-grow: 1;
  }

  .task-item .task-content span {
    margin-right: auto;
  }

  .task-item .icons {
    display: flex;
    gap: 10px;
  }

  .task-item.completed span {
    text-decoration: line-through;
    color: gray;
  }

  .search-field {
    margin-bottom: 20px;
  }

  .search-field input {
    width: 90%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    border-color: green;

  }
</style>
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
    <form method="post" action="../delete-all.php">
        <button type="submit" name="deleteAll">Delete All</button>
    </form>
  </div>
  <div class="search-field">
    <input type="text" id="search" placeholder="Search tasks" onkeyup="searchTasks()">
  </div>
  <div class="task-list" id="task-list">
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
          <div class='task-item' data-id='".$row['id']."'>
              <div class='task-content'>
                <input type='checkbox' id='task".$row['id']."' onchange='markCompleted(this)'>
                <span>" . htmlspecialchars($row['name']) . "</span>
              </div>
              <div class='icons'>
                <a href='../delete.php?id=".$row['id']."'><i class='fa fa-times'></i></a>
                <a href='../edit.php?id=".$row['id']."'><i class='fa-solid fa-marker'></i></a>
              </div>
          </div>
          ";
      }

      $connection->close();
    ?>
  </div>
</div>
<script src="https://kit.fontawesome.com/523d8fe978.js" crossorigin="anonymous"></script>
<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    loadTasks();
  });

  function markCompleted(checkbox) {
    var taskId = checkbox.id.replace('task', '');
    var isCompleted = checkbox.checked;

    var taskItem = checkbox.parentElement.parentElement;
    if (isCompleted) {
      taskItem.classList.add('completed');
    } else {
      taskItem.classList.remove('completed');
    }

    saveTaskCompletionStatus(taskId, isCompleted);
  }

  function saveTaskCompletionStatus(taskId, isCompleted) {
    var completedTasks = JSON.parse(localStorage.getItem('completedTasks')) || {};
    completedTasks[taskId] = isCompleted;
    localStorage.setItem('completedTasks', JSON.stringify(completedTasks));
  }

  function loadTasks() {
    var completedTasks = JSON.parse(localStorage.getItem('completedTasks')) || {};
    var taskItems = document.querySelectorAll('.task-item');

    taskItems.forEach(taskItem => {
      var taskId = taskItem.getAttribute('data-id');
      if (completedTasks[taskId]) {
        taskItem.classList.add('completed');
        taskItem.querySelector('input[type="checkbox"]').checked = true;
      }
    });
  }

  function searchTasks() {
    var input, filter, taskList, taskItems, taskContent, i, txtValue;
    input = document.getElementById('search');
    filter = input.value.toLowerCase();
    taskList = document.getElementById('task-list');
    taskItems = taskList.getElementsByClassName('task-item');

    for (i = 0; i < taskItems.length; i++) {
      taskContent = taskItems[i].getElementsByClassName('task-content')[0];
      txtValue = taskContent.textContent || taskContent.innerText;
      if (txtValue.toLowerCase().indexOf(filter) > -1) {
        taskItems[i].style.display = "";
      } else {
        taskItems[i].style.display = "none";
      }
    }
  }
</script>
</body>
</html>
