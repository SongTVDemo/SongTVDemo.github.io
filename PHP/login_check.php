<?php
function acc_head() {
  if (isset($_SESSION['ID'])) {
    echo "<div class='login' style='right:50px; width:280px'>
      <span>";
    echo $_SESSION['Name'];
    echo "</span>
    <div class='drop-in' style='right:-10px'>";
    if ($_SESSION['Type'] == 2) {
      echo "<form>
        <input class='newbutton' type='submit' value='My Page' style='top:10px'>
      </form>
      <form action='PHP/logout.php'>
        <input class='newbutton' type='submit' value='Log Out' style='top:45px'>
      </form>
      <form method='post' action='PHP/d_stv.php'>
        <input class='n_stv' name='n_stv' type='text' value='New Song TV' onclick=value=''>
        <input class='newbutton' type='submit' value='Submit' style='top:110px'>
      </form></div></div>";
    } else {
      echo "<form>
        <input class='newbutton' type='submit' value='My Page' style='top:40px'>
      </form>
      <form action='PHP/logout.php'>
        <input class='newbutton' type='submit' value='Log Out' style='top:80px'>
      </form></div></div>";
    }
  } else {
    echo "<div class='login'>
      <span>Login</span>
      <div class='drop-in'>
        <form method='post' action='PHP/login.php'>
          <table>
            <tr>
              <td>Username:</td>
              <td><input type='text' name='user' value='Username' onclick=value=''><br></td>
            </tr>
            <tr>
              <td>Password:</td>
              <td><input type='password' name='pass' value='Password' onclick=value=''><br></td>
            </tr>
          </table>
          <input class='logbutton' type='submit' value='Login'>
        </form>
        <form action='new_account.php'>
          <input class='accbutton' type='submit' value='Create Account'>
        </form>
      </div>
    </div>
    <div class='vert'>|</div>
    <a class='new_band' href='new_band.php'>Add a band</a>";
  }
}
?>
