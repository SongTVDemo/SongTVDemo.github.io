<html>
<body>
<?php
  session_start();

  if ($_GET['city']=='null') {
    unset($_SESSION['city']);
  } else {
    $_SESSION['city']=$_GET['city'];
  }

  echo "<script type='text/javascript'>location.href = 'http://localhost:8888/home.php';</script>";
?>
</body>
</html>
