<?php
require_once "config.php";
require_once "session.php";
require_once 'functions.php';
global $flag;
$result3 = dis();
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
  <h1><center>Library Notification Management System</center></h1>
</div>
<div>
  <ul><li><a href="main.php">List</a></li>
    <li><a class="active" href="report.php">Report</a></li>
    <li><a  href="search.php">Book Search</a></li>
    <li><a href="enrolment.php">Enrollment</a></li>
    <li><a href="dash.html">Dashboard</a></li>
    <li style="float:right"><a href="login.php">Logout</a></li>
  </ul>
</div>
<div class="modd">
<?php 
    if(isset($_POST['Submit'])){
      $result3 = dis();
      $one=1;
        }
  ?>
  <form action="" method="post"><br>
    <label style="font-family:verdana" style="font-size:25px" for="fname">Start Date:</label>
    <input type="datetime-local" id="fname" name="fname"><br><br>
    <label for="lname" style="font-family:verdana" style="font-size:25px">End Date:</label>
    <input type="datetime-local" id="lname" name="lname"><br><br>
    <h3 style="font-family:verdana" style="font-size:30px" padding="5px">Select Criteria</h3>
    <input type="radio" id="html" name="fav" value="borrow">
    <label for="html" style="font-family:verdana" style="font-size:25px" >Borrow</label><br>
    <input type="radio" id="css" name="fav" value="duta">
    <label for="css" style="font-family:verdana" style="font-size:25px">Return</label><br>
    <input type="radio" id="javascript" name="fav" value="log">
    <label for="javascript" style="font-family:verdana" style="font-size:25px">Log</label><br><br><center>
    <input type="submit" name="search" class="button button-1" value="Search">
    <input type="submit" name="generate" class="button button-1" value="Generate"></center>
</form> 
      </div>
<div>
<table>
  <thead><tr>
    <th>Book ID</th>
    <th>Role</th>
    <th>Book Name</th>
    <th>Date</th>
    <th>Due Date(B)/Fine(R)/Purpose(L)</th>
</thead>
<tbody>
<tr>
<?php
  while($row=mysqli_fetch_assoc($result3)){
?>
<td><?php echo $row['bid']??''; ?></td>
<td><?php echo $row['role_id']??''; ?></td> 
<td><?php echo $row['book']??''; ?></td> 
<td><?php if($_POST['fav']=='borrow') echo $row['sdate']??'';
          elseif($_POST['fav']=='duta') echo $row['sdate']??'';
          else echo $row['date']??'' ?></td> 
<td><?php if($_POST['fav']=='borrow') echo $row['edate']??'';
          elseif($_POST['fav']=='duta') echo $row['fine']??'';
          else echo $row['purpose']??'' ?></td>   
</tr>
<?php
}
 ?>
 </tbody>
</table>   
</div>
</body>
</html>