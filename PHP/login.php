<html>
<body>
<?php
  session_start();
  $mysqli = mysqli_connect("localhost:3306", "root", "root", "login");

  $user = $_POST['user'];
  $pass = $_POST['pass'];

  $sql = "SELECT * FROM users WHERE User='$user' and Password='$pass'";
  $login = mysqli_query($mysqli,$sql);

  $sql_b = "SELECT * FROM bands WHERE User='$user' and Password='$pass'";
  $login_b = mysqli_query($mysqli,$sql_b);

  if (!$row = mysqli_fetch_assoc($login)) {
    if (!$row_b = mysqli_fetch_assoc($login_b)) {
      echo "<script type='text/javascript'>alert('Incorrect username or password');</script>";
    } else {
      $_SESSION['ID'] = $row_b['ID'];
      $_SESSION['Name'] = $row_b['Name'];
      $_SESSION['Type'] = 2;
    }
  } else {
    $_SESSION['ID'] = $row['ID'];
    $_SESSION['Name'] = $row['Name'];
    $_SESSION['Type'] = 1;
  }

  $mysqli->close();

  echo "<script type='text/javascript'>location.href = 'http://localhost:8888/home.php';</script>";
?>
</body>
</html>
