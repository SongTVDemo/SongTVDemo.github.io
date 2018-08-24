<?php
	session_start();
?>
<!doctype html>
<html>
<head>
	<title>Create Account</title>
	<link rel="stylesheet" type="text/css" href="CSS/main.css">
	<script type="text/javascript" src=JS/main.js></script>
</head>
<body>
	<div class="page_head">
		<a class="logo" href="home.php">SongTV</a>
	</div>
	<div class="center">
		<div class="col-3"></div>
		<div class="col-4">
			<form method="post" action="PHP/new_acc.php">
				<table style="width:100%">
					<tr>
						<td>Name:</td>
						<td><input type="text" name="name"><br></td>
					</tr>
					<tr>
						<td>Username:</td>
						<td><input type="text" name="user"><br></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><input type="text" name="email"><br></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name="pass"><br></td>
					</tr>
					<tr>
						<td>Confirm Password:</td>
						<td><input type="password" name="pass2"><br></td>
					</tr>
				</table>
				<input class="logbutton" type="submit" value="Add Account">
			</form>
		</div>
		<div class="col-3"></div>
	</div>
	<div class="page_foot">
		<p>Legal Stuff</p>
	</div>
</body>
</html>
