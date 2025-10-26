<?php

require_once "config.php";
require_once "session.php";

$success ='';
$error ='';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	$fullname = trim($_POST['name']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$confirm_password = trim($_POST["confirm_password"]);
	$password_hash = password_hash($password, PASSWORD_BCRYPT);
    if($query = $db->prepare("SELECT * FROM user WHERE email = ?")) {
		$error ='';
		
	$query->bind_param('s', $email);
	$query->execute();
	
	$query->store_result();
	    if ($query->num_rows > 0) {
			$error .= '<p class="error">The mail address is already registered!</p>';
		}else{
			
			if(strlen($password) < 6) {
				$error .='<p class="error">Password must have atleast 6 characters.</p>';
			}
			if(empty($confirm_password)) {
				$error .='<p class="error">Password did not match.</p>';
			} else {
				if (empty($error)&&($password != $confirm_password)) {
					$error .='<p class="error">Password did not match.</p>';
				}
			}
			if (empty($error)) {
				$insertQuery = $db->prepare("INSERT INTO user (name,email,password) VALUES (?,?,?);");
				$insertQuery->bind_param("sss", $fullname, $email, $password);
				$result = $insertQuery->execute();
				if($result){
					// Registration success
					$successMessage = 'Your registration was successful!';
					echo '<script>showPopup("' . $successMessage . '", false);</script>';
				}else{
				   // Registration failed
				   $errorMessage = 'Something went wrong!';
				   echo '<script>showPopup("' . $errorMessage . '", true);</script>';
				}
			}
		}
	}
    $query->close();
    //$insertQuery->close();
	//close db conection
	mysqli_close($db);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	    <meta charset="UTF-8">
		<title>Sign Up</title>
		<link rel="stylesheet"href="stylereg.css">
	</head>
	<body>
		<div class="module">
	    <div class="container">
			<h1>LIBRARY NOTIFICATION MANAGEMENT SYSTEM</h1><br>
			<h2 >Register</h2><br>
		    <div class="row">
			    <div class="col-md-12">
					<?php echo $success; ?>
					<?php echo $error; ?>
					<form action="" method="post">
					    <div class="form-group">
					        <label style="font-family:verdana" style="font-size:20px"><p>Full Name</p></label>
						    <input type="text"placeholder="Enter name" name="name" class="form-control" required>
						</div>
						<div class="form-group">
					        <label style="font-family:verdana" style="font-size:20px"><p>Email Address</p></label>
						    <input type="email"placeholder="enter email" name="email" class="form-control" required>
						</div>
						<div class="form-group">
					        <label style="font-family:verdana" style="font-size:20px"><p>password</p></label>
						    <input type="password"placeholder="enter password" name="password" class="form-control" required>
						</div>
						<div class="form-group">
						    <label style="font-family:verdana" style="font-size:20px"><p>Confirm Password</p></label>
							<input type="password"placeholder="retype password" name="confirm_password" class="form-control" required>
						</div><br>
						<div class="form-group">
						    <input type="submit" name="submit" class="btn btn-primary" value="submit">
						</div>
						<p1>Already have an account? <a href="login.php">login here</a>.</p1>

					</form>
				</div>	
			</div>
        </div>  
	</body>
</html>	