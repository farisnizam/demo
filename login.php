<?php
session_start();
$message="";
if(count($_POST)>0) {

	include("dbconnect.php");

	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE username = '$username' 
			and password = '$password'";

	$result = mysqli_query($conn,$sql);
	$row  = mysqli_fetch_array($result);

	if(is_array($row)) {
		$_SESSION["id"] = $row['id'];
		$_SESSION["name"] = $row['username'];
		$_SESSION["role"] = $row['role'];
	} else {
		$message = "Invalid Username or Password!";
	}
}

if(isset($_SESSION["id"])) {
	if($_SESSION["role"] == "admin") {
		header("Location:search-admin.php");
	} else if ($_SESSION["role"] == "user"){
		header("Location:index.php");
	}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="mx-auto mt-5" style="width: 30%;">
			<h2>Login Form</h2>

			<form action="" method="POST">
				<div class="message"><?php if($message!="") { echo $message; } ?></div>
				<label>User Name:</label><br>
				<input class="form-control" type="text" name="username">
				<br>
				<label>Password:</label><br>
				<input class="form-control" type="password" name="password">
				<br>
				<br>
				<input class="form-control btn btn-primary" type="submit" value="submit">
			</form>
		</div>
	</div>

</body>
</html>