<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Todo List</title>
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-size: cover;
    background-image: url('../images/Download wallpaper 1366x768 green, octopus, drawing tablet, laptop hd background.jpeg');
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
  }

  .container {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    padding: 20px;
    width: 300px;
    text-align: center;
  }

  .title {
    font-size: 24px;
    margin-bottom: 20px;
  }

  .input-field {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
  }

  .input-field input {
    padding: 10px;
    border: none;
    border-radius: 5px 0 0 5px;
    width: 70%;
  }

  .input-field button {
    padding: 10px;
    border: none;
    background: #4CAF50;
    color: white;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
  }

  .buttons {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
  }

  .buttons button {
    padding: 10px;
    border: none;
    background: #4CAF50;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    flex: 1;
    margin: 0 5px;
  }


</style>
</head>
<body>
<div class="container">
  <div class="title">Todo List</div>
  <div class="input-field">
    <input type="text" placeholder="Add a new task">
    <button>+</button>
  </div>
  <div class="buttons">
    <button>Complete</button>
    <button>Incomplete</button>
    <button>Delete All</button>
  </div>

</div>
</body>
</html>
