<html>
<body>
<?php
  session_start();
  $mysqli = mysqli_connect("localhost:3306", "root", "root", "login");

  $n_stv = $_POST['n_stv'];
  $ID = $_SESSION['ID'];

  mysqli_query($mysqli,"UPDATE bands SET Stv='$n_stv', Views=0 WHERE ID=$ID");

  mysqli_close($mysqli);

  echo "<script type='text/javascript'>location.href = 'http://localhost:8888/home.php';</script>";
?>
</body>
</html>
