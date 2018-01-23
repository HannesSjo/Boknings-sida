<?php
  session_start();
  include 'includes/db.php';

  if (isset($_POST['register'])) {
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $username = mysqli_real_escape_string($connection, $username);
  $password = mysqli_real_escape_string($connection, $password);
  $email = mysqli_real_escape_string($connection, $email);

  $hashFormat ="$2y$10$";
  $salty = "EmilHasGayEmilHasGdsayE";

  $saltyHash = $hashFormat . $salty;

  $password = crypt($password ,$saltyHash);

  $query = "SELECT username FROM users WHERE username = '{$username}'";
  $isUsernameInUse = mysqli_query($connection, $query);

  if (mysqli_num_rows($isUsernameInUse) != 0) {
      echo "<div class='taken'>Username is alredy in use!</div>";
  }
  else {
    $query2 = "INSERT INTO users (email, username, password) ";
    $query2 .= "VALUES ('$email', '$username', '$password')";

    $result = mysqli_query($connection, $query2);

    if (!$result) {
      die('FAIled');
    }
    header("Location: login.php");
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
    <form action="register.php" method="post">
      <h1>Register</h1>
      <input type="email" name="email" placeholder="E-mail" required>
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input class="submit" type="submit" name="register" value="Register">
    </form>
  </body>
</html>
