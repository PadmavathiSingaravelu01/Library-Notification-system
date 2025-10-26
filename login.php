<?php

require_once "config.php";
require_once "session.php";
global $flag;
$error ='';
if ($_SERVER["REQUEST_METHOD"] =="POST" && isset($_POST['submit'])) {
	
	$email =trim($_POST['email']);
	$password =trim($_POST['password']);
	echo $password;
	$query ="SELECT * FROM user WHERE email= '$email'";
	echo $query;
    $result = mysqli_query($db, $query);
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
		  echo "id: " . $row["name"]. " - Name: " . $row["email"]. " " . $row["password"]. "<br>";
		  if($email == $row["email"] && $password == $row["password"]){
			echo "users exits";
			$flag =1;
			header('Location: main.php');
		  }
		  else if($email != $row["email"] && $password == $row["password"])
		  {
			echo "email does not matched";
			$flag =2;
		  }
		  else if($email == $row["email"] && $password != $row["password"]){
			echo "password does not matched";
			$flag =3;
		  }
		}
	  } else {
		echo "enter correct credentials";
		$flag=4;
	  }
	  echo $flag;
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
	    <meta charset="UTF-8">
		<title>Login</title>
		<link rel="stylesheet" href="stylereg.css">
	</head>
	<body>
		<div class="module">
	    <div class="container">
		<h1>LIBRARY NOTIFICATION MANAGEMENT SYSTEM</h1>
		    <div class="row">
			    <div class="col-md-12">
				    <h2>Login</h2>
					<?php echo $error; ?>
					<form action="" method="post">
					    <div class="form-group">
						    <label style="font-family:verdana" style="font-size:30px"><p>Email address</p></label>
							<input type="email"placeholder="enter email id" name="email" class="form-control" required />
						</div>
						<div class="form-group">
						    <label style="font-family:verdana" style="font-size:30px"><p>Password</p></label>
						    <input type="password"placeholder="enter password" name="password" class="form-control" required>
							<div class="group">
							<i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                            </div>
						</div>
						<div class="form-group">
						    <input type="submit" name="submit" class="btn btn-primary" value="submit">
							<br>
							<p1>Don't have an account?<a href="register.php">Register here</a>.</p1>
						</div>
					</form>
				</div>
			</div>
		</div>

	</body>
</html>