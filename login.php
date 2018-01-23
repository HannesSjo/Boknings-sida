<?php
  session_start();
  include 'includes/db.php';

  $db_username = '';
  $db_password = '';

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $username = mysqli_real_escape_string($connection, $username);
  $password = mysqli_real_escape_string($connection, $password);


  $query = "SELECT * FROM users WHERE username = '{$username}'";
  $select_user_query = mysqli_query($connection, $query);

  if (!$select_user_query) {
    die('Query failed') . mysqli_error($connection);
  }
  while ($row = mysqli_fetch_array($select_user_query)) {
    $db_id = $row['id'];
    $db_username = $row['username'];
    $db_password = $row['password'];
  }

  $password = crypt($password, $db_password);

  if ($username === $db_username && $password === $db_password) {
    $_SESSION['id'] = $db_id;
    $_SESSION['username'] = $db_username;
    header("Location: index.php");
  }
  else {
    echo "<div class='taken'>Wrong Username / Password!</div>";
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Log In</title>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
    <form action="login.php" method="post">
      <h1>Log In</h1>
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input class="submit" type="submit" name="login" value="Log In">
    </form>
    <a href="register.php">Don't have account register here</a>
  </body>
</html>
