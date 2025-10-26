<?php
require_once "config.php";
require_once "session.php";
require_once 'functions.php';
global $flag;
$result4 = diss();
?>
<!DOCTYPE html>
<html>
<head>
<title>Book Search</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
  <h1><center>Library Notification Management System</center></h1>
</div>
<div>
  <ul><li><a href="main.php">List</a></li>
    <li><a href="report.php">Report</a></li>
    <li><a class="active" href="search.php">Book Search</a></li>
    <li><a href="enrolment.php">Enrollment</a></li>
    <li><a href="dash.html">Dashboard</a></li>
    <li style="float:right"><a href="login.php">Logout</a></li>
  </ul>
</div>
<div class="mod"><center>
<?php 
    if(isset($_POST['submit'])){
      $result4 = diss();
        }
  ?>
  <form method="post">
    <label for="name" style="font-family:verdana" style="font-size:25px">Book Name:</label>
    <input type="text" id="name" name="name"  size="50"><br><br>
    <input type="submit" class="button button-1" value="Search"></center>
    </form>
</div>
<br><br>
<div class="mod">
<table>
  <thead><tr>
    <th>Book Name</th>
    <th>Book Id</th>
    <th>Status</th></tr>
 </thead>
 <tbody>
<tr>
<?php
  while($row=mysqli_fetch_assoc($result4)){
?>
<td><?php echo $row['name']??''; ?></td>
<td><?php echo $row['id']??''; ?></td> 
<td><?php echo $row['status']??''; ?></td> 
</tr>
<?php
}
 ?>
 </tbody>
</table>   
</div>  
</body>
</html>