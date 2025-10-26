<?php

require_once "config.php";
require_once "session.php";

$success ='';
$error ='';
date_default_timezone_set("Asia/Calcutta");
$sdate=date("Y-m-d h:i:s");
$d=strtotime("+14 Days");
$edate=date("Y-m-d h:i:s", $d);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	$num = trim($_POST['num']);
	$id = trim($_POST['bookid']);
    if($query = $db->prepare("SELECT * FROM borrow WHERE bid = ?")) {
		$error ='';
		
	$query->bind_param('s', $id);
	$query->execute();
	
	$query->store_result();
	    if ($query->num_rows > 0) {
			$error .= '<p class="error">The book is already taken by someone!</p>';
		}else{
			
			if(strlen($id) < 3) {
				$error .='<p class="error">book id must have atleast 4 integers.</p>';
			}
			if (empty($error)) {
				$insertQuery = $db->prepare("INSERT INTO borrow (bid, role_id,sdate, edate) VALUES (?,?,?,?);");
				$insertQuery->bind_param("ssss", $id, $num, $sdate, $edate);
				#echo $sdate;
				$result = $insertQuery->execute();
				$update = $db->prepare("UPDATE borrow SET book = (select name from book where id = ?) WHERE bid=?");
				$update->bind_param("ss", $id,$id);
				$result2=$update->execute();
				$bookt = $db->prepare("UPDATE book SET status = 'C' WHERE id=?");
				$bookt->bind_param("s", $id);
				$result3=$bookt->execute();
				#echo $result2;
				if($result){
				   $error .='<p class="success">Book updated successful!</p>';
				   $to = $num."@mail.sjctni.edu";
				   $subject = "Book borrowing";
				   $message = "Your are taken book id:". $id. " and will be returning on ".$edate;
				   $header = "Due date:".$edate;
				   //Send email
				   if(mail($to, $subject, $message, $header)){
					  # echo "email sent successfully";
				   }else {
					  # echo "Email failed";
				   }
				}else{
				   $error .='<p class="error">Something went wrong!</p>';
				}
				$insertQuery->close();
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
		<title>Enrolment</title>
		<link rel="stylesheet"href="stylereg.css">		
	</head>
	<body>
		<div class="header">
			<h1><center>Library Notification Management System</center></h1>
		  </div>
		  <div>
			<ul><li><a  href="main.php">List</a></li>
			  <li><a href="report.php">Report</a></li>
			  <li><a href="search.php">Book Search</a></li>
			  <li><a class="active" href="enrolment.php">Enrolment</a></li>
			  <li><a href="dash.html">Dashboard</a></li>
			  <li style="float:right"><a href="login.php">Logout</a></li>
			</ul>
		  </div>
		  <br>
	    <div class="module">
		    <div class="container">
			    <div class="col-md-12">
				    <center>
				    <h2>BOOK BORROWING</h2>
					</center><br>
					<h3>Please fill the details correctly</h3><br>
					<form action="" method="post">
					    <div class="form-group">
					        <label style="font-family:verdana" style="font-size:25px"><p>D.no:</p></label>
						    <input type="text" name="num" class="form-control" required>
						</div>
						<div class="form-group">
					        <label style="font-family:verdana" style="font-size:25px"><p>Book id:</p></label>
						    <input type="text" name="bookid" class="form-control" required  />
						</div><br>
						<div class="form-group">
						    <input type="submit" name="submit" class="btn btn-primary" value="submit">
						</div>
						<p>For Book Returning <a href="return.php">Return here</a>.</p>
					</form>
				</div>	
			</div>
        </div>
	</body>
</html>