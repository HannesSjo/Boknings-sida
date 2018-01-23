<?php
  $connection = mysqli_connect("localhost", "root", "root", "db_bokningsida");
  if (!$connection) {
    die('Connection failed!' . mysqli_error($connection));
  }
 ?>
