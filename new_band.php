<?php
	session_start();
?>
<!doctype html>
<html>
<head>
	<title>New Band</title>
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
			<form method="post" action="PHP/new_band_acc.php">
				<table style="width:100%">
					<tr>
						<td>Band Name:</td>
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
						<td>SongTV:</td>
						<td><input type="text" name="stv"><br></td>
					</tr>
					<tr>
						<td>Location:</td>
						<td style="padding:0px"><select type="text" name="loc" style="width:100%">
  						<option value="Los Angeles">Los Angeles</option>
  						<option value="London">London</option>
  						<option value="Madrid">Madrid</option>
  						<option value="Rio">Rio</option>
							<option value="Tokyo">Tokyo</option>
  						<option value="Abu Dhabi">Abu Dhabi</option>
  						<option value="Pretoria">Pretoria</option>
  						<option value="Chicago">Chicago</option>
						</select><br></td>
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
