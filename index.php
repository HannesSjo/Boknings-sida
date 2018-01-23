  <?php
    session_start();
    if (!$_SESSION['username']) {
      header('Location: login.php');
    }
    include "includes/db.php";
    $title = "Book Page";

    $query = "SELECT * FROM users WHERE id = {$_SESSION['id']} ";
    $result = mysqli_query($connection, $query);

      while ($row = mysqli_fetch_array($result)) {
        $email = $row['email'];
      }


    if (isset($_POST['submit'])) {
      $user_id = $_SESSION['id'];
      $username = $_SESSION['username'];
      $date = $_POST['date'];
      $date2 = $_POST['date2'];
      $from = $_POST['from'];
      $destination = $_POST['destination'];
      $passangers = $_POST['passangers'];

        if ($date <= $date2) {
          if ($from != $destination) {
            $date = mysqli_real_escape_string($connection, $date);
            $date2 = mysqli_real_escape_string($connection, $date2);
            $from = mysqli_real_escape_string($connection, $from);
            $destination = mysqli_real_escape_string($connection, $destination);
            $passangers = mysqli_real_escape_string($connection, $passangers);

            $query = "INSERT INTO bokings (email, username, user_id, startDate, returnDate, startPlace, destination, passangers)";
            $query .= "VALUES ('$email', '$username', '$user_id', '$date', '$date2', '$from', '$destination', '$passangers')";
            $result = mysqli_query($connection, $query);
          }
          else {
            $errorMsg = "U need to select 2 diffrent locations";
          }
        }
        else {
          $errorMsg = "We can't time travel yet :(";
        }
      }
   ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Book Page</title>
    <link rel="stylesheet" href="css/index.css">
  </head>
  <body>
    <nav>
      <h1>Boknings Sidan</h1>
      <a href="logout.php">Log Out</a>
    </nav>

    <form action="index.php" method="post">
        <h2>From</h2>
      <select name="from">
        <option>Tyskland</option>
        <option>Finland</option>
        <option>Canada</option>
        <option>Japan</option>
        <option>Australien</option>
      </select>
      <h2>Destination</h2>
      <select name="destination">
        <option>Tyskland</option>
        <option>Finland</option>
        <option>Canada</option>
        <option>Japan</option>
        <option>Australien</option>
      </select>
      <h2>Start Date/Return Date</h2>
        <input type="date" name="date" required>
        <input type="date" name="date2" required>
        <h2>Passangers</h2>
        <select name="passangers">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
          <option>7</option>
          <option>8</option>
          <option>9</option>
          <option>10</option>
        </select>
        <input class="button" type="submit" name="submit" value="Submit">

    </form>
      <table>
        <tr>
          <th>Username</th>
          <th>E-mail</th>
          <th>Start Date / Return Date</th>
          <th>From</th>
          <th>To</th>
          <th>Travalers</th>
        </tr>
        <?php
        $query = "SELECT * FROM bokings WHERE user_id = {$_SESSION['id']} ";
        $result = mysqli_query($connection, $query);

          while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>". $row['startDate'] . " / " . $row['returnDate'] . "</td>";
            echo "<td>" . $row['startPlace'] . "</td>";
            echo "<td>" . $row['destination'] . "</td>";
            echo "<td>" . $row['passangers'] . "</td>";
            echo "</tr>";
          }
        ?>
      </table>

      <?php
      if (isset($errorMsg)) {
      echo "<div class='alert'>";
        echo $errorMsg;
        }
        echo "</div>";
       ?>
  </body>
</html>
