<html>
<body>
<?php
  session_start();
  $mysqli = mysqli_connect("localhost:3306", "root", "root", "login");

  $name = $_POST['name'];
  $user = $_POST['user'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $pass2 = $_POST['pass2'];

  if ($name != '' and $user !='' and $email != '' and $pass != '') {
    if ($pass == $pass2){
      $sql = "INSERT INTO users(User, Password, Name, Email) VALUES ('$user', '$pass', '$name', '$email')";
    } else {
      echo "<script type='text/javascript'>alert('Passwords do not match');</script>";
    }
  } else {
    echo "<script type='text/javascript'>alert('Please fill out all fields');</script>";
  }

  $signup = mysqli_query($mysqli,$sql);
  $mysqli->close();

  echo "<script type='text/javascript'>location.href = 'http://localhost:8888/home.php';</script>";
?>
</body>
</html>
